<?php


namespace App\Plugins\UEditor;


class Config implements Contracts\UEditor
{
    public function handle(): array
    {
        return config('ueditor');
    }
}