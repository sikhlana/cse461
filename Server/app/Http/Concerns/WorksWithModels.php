<?php

namespace App\Http\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait WorksWithModels
{
    abstract protected function getInputForSave(Request $request);

    protected function saved(Model $model, $action = null, $message = null, ...$parameters)
    {
        if ($model->wasRecentlyCreated) {
            return $this->created($model, $action, $message, ...$parameters);
        } else {
            return $this->updated($model, $action, $message, ...$parameters);
        }
    }

    protected function created(Model $model, $message = null, $action = null, ...$parameters)
    {
        if (is_null($message)) {
            $message = sprintf('Successfully created a new %s.', snake_case(class_basename($model), ' '));
        }

        return $this->redirect($this->getRedirectPath($action, ...$parameters), $message, $model->getKey());
    }

    protected function updated(Model $model, $message = null, $action = null, ...$parameters)
    {
        if (is_null($message)) {
            $message = sprintf('Successfully updated the %s.', snake_case(class_basename($model), ' '));
        }

        return $this->redirect($this->getRedirectPath($action, ...$parameters), $message, $model->getKey());
    }

    protected function deleted(Model $model, $message = null, $action = null, ...$parameters)
    {
        if (is_null($message)) {
            $message = sprintf('Successfully deleted the %s.', snake_case(class_basename($model), ' '));
        }

        return $this->redirect($this->getRedirectPath($action, ...$parameters), $message);
    }

    protected function redirect($to, $message, $hash = null)
    {
        if ($to) {
            if (! is_null($hash)) {
                $to .= '#_' . $hash;
            }

            return redirect()->to($to)->withHeaders([
                'X-Message' => $message,
            ]);
        } else {
            return response()->json([
                'message' => $message,
            ]);
        }
    }

    protected function getRedirectPath($action, ...$parameters)
    {
        if (! is_string($action)) {
            $action = 'index';
        }

        if (! method_exists($this, $action)) {
            return false;
        }

        return app('url')->action('\\' . get_class($this) . '@' . $action, $parameters);
    }

    protected function deleteModel(Request $request, Model $model, $route = null, $message = null)
    {
        if ($request->isMethod('DELETE') || $request->isMethod('POST')) {
            $model->delete();

            return $this->deleted($model);
        } else {
            $name = snake_case(class_basename($model), ' ');

            if (is_null($message)) {
                $message = sprintf('Are you sure you want to delete this %s?', $name);
            }

            return view('delete_model')->with(compact([
                'message', 'route', 'model', 'name',
            ]));
        }
    }
}