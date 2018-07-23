<?php

namespace App\Http\Concerns;

use App\Attachment;
use Image;

trait CreatesImageAttachmentsFromDataUri
{
    protected function fetchImageAttachments(&$content)
    {
        $images = collect();

        $content = preg_replace_callback('%(<img[^>]+src=(["\']))(data:image/(.*?);base64,[^"\']+)(\2[^>]*>)%i', function ($matches) use ($images) {
            $image = Image::make($matches[3]);

            $temp = tempnam(sys_get_temp_dir(), 'bracu');
            file_put_contents($temp, $image->encode($matches[4], 90));

            /** @var Attachment $attachment */
            $attachment = Attachment::newModelInstance([
                'title' => str_random(60) . '.' . $matches[4],
            ]);

            $attachment->upload(new \SplFileInfo($temp));
            @unlink($temp);

            $images->push($attachment);

            return $matches[1] . $attachment->getUrl() . $matches[5];
        }, $content);

        return $images;
    }


}