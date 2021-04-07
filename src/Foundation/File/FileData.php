<?php

namespace Maestriam\FileSystem\Foundation\File;

use DateTime;

class FileData
{
    public string $name;

    public string $folder;

    public string $absolute_path;

    public string $content;
    
    public DateTime $created_at;

    public DateTime $updated_at;     
}