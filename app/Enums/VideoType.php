<?php

namespace App\Enums;

enum VideoType: string
{
    case YouTube = 'YouTube';
    case Vimeo = 'Vimeo';
    case Wistia = 'Wistia';
    case Dropzone = 'Dropzone';
}
