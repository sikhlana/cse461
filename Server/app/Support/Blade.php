<?php

namespace App\Support;

use Illuminate\View\Factory;

class Blade
{
    public static function register()
    {
        \Blade::directive('title', function ($expression) {
            return '<?php $__env->startSection(\'page-title\', ' . $expression . '); ?>';
        });

        \Blade::directive('h1', function ($expression) {
            return '<?php $__env->startSection(\'page-h1\', ' . $expression . '); ?>';
        });

        \Blade::directive('noH1', function () {
            return '<?php $__env->startSection(\'page-h1\', \'\'); ?>';
        });

        \Blade::directive('hasH1', function ($expression) {
            $expression = '$__env' . ($expression ? ', ' . $expression : '');

            return '<?php if (' . static::class . '::hasPageHeading(' . $expression . ')): ?>';
        });

        \Blade::directive('yieldH1', function ($expression) {
            $expression = '$__env' . ($expression ? ', ' . $expression : '');

            return '<?php echo ' . static::class . '::yieldPageHeading(' . $expression . ') ?>';
        });

        \Blade::directive('description', function ($expression) {
            return '<?php $__env->startSection(\'page-description\', ' . $expression . '); ?>';
        });

        \Blade::directive('yieldDescription', function () {
            return '<?php echo $__env->yieldContent(\'page-description\', config(\'app.description\')); ?>';
        });

        \Blade::directive('body', function ($expression) {
            return '<?php $__env->startSection(\'page-body\', ' . $expression . '); ?>';
        });

        \Blade::directive('yieldBody', function () {
            return '<?php echo $__env->yieldContent(\'page-body\', \'default\'); ?>';
        });

        \Blade::directive('yieldIf', function ($expression) {
            return '<?php echo ' . static::class . '::yieldContentIf($__env, ' . $expression . ') ?>';
        });

        \Blade::directive('ifRoute', function ($expression) {
            return '<?php echo ' . static::class . '::ifRoute(' . $expression . ') ?>';
        });

        \Blade::directive('ifRoutePrefix', function ($expression) {
            return '<?php echo ' . static::class . '::ifRoutePrefix(' . $expression . ') ?>';
        });

        \Blade::directive('setvar', function ($expression) {
            return preg_replace('/^\'(.*?)\',\s+\'(.*?)\'.*$/i', '<?php \$$1 = \'$2\'; ?>', $expression);
        });

        \Blade::directive('jsonAttr', function ($expression) {
            return '<?php echo ' . static::class . '::jsonAttr(' . $expression . ') ?>';
        });

        \Blade::directive('navIsSelected', function ($expression) {
            return '<?php echo ' . static::class . '::navIsSelected(' . $expression . ') ?>';
        });

        \Blade::directive('isChecked', function ($expression) {
            return '<?php echo ' . static::class . '::isChecked(' . $expression . ') ?>';
        });
    }

    public static function hasPageHeading(Factory $env, $fallback = true)
    {
        $value = $env->yieldContent(
            'page-h1',
            $fallback ? $env->yieldContent('page-title') : ''
        );

        return ! empty($value);
    }

    public static function yieldPageHeading(Factory $env, $fallback = true)
    {
        $value = $env->yieldContent(
            'page-h1',
            $fallback ? $env->yieldContent('page-title') : ''
        );

        if (! $value) {
            return null;
        }

        return html_entity_decode($value, ENT_QUOTES, 'UTF-8');
    }

    public static function yieldContentIf(Factory $env, $variable, $prefix = '', $suffix = '')
    {
        $value = $env->yieldContent($variable);

        if (empty($value)) {
            return '';
        }

        return $prefix . $value . $suffix;
    }

    public static function ifRoute($route, $if, $not = '')
    {
        return optional(request()->route())->getName() == $route ? $if : $not;
    }

    public static function ifRoutePrefix($route, $if, $not = '')
    {
        return strpos(optional(request()->route())->getName() ?? '', $route) === 0 ? $if : $not;
    }

    public static function jsonAttr($data)
    {
        return e(json_encode($data, 15, 512));
    }

    public static function navIsSelected($route)
    {
        if (self::ifRoutePrefix($route, true)) {
            return 'data-selected';
        }

        return '';
    }

    public static function isChecked($truth)
    {
        if ($truth) {
            return 'checked';
        }

        return '';
    }
}