<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

function pre($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function uploadS3Image($pathUrl, $file)
{
    try {
        $path = Storage::disk('s3')->put($pathUrl, $file);

        return $path;
    } catch (\Exception $ex) {

    }
}

function uploadS3ImageThumb($pathUrl, $file, $width = null, $height = null)
{
    try {
        // Resize the image (adjust width and height as needed)
        $img = Image::make($file->getRealPath())
            ->resize(800, 600, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize(); // Prevent upsizing
            })
            ->encode('jpg', 75); // Adjust quality (0-100) if needed

        // Generate a unique filename
        $filename = $file->getFileName();

        // Store the image on S3
        $fullPath = $pathUrl.'/'.$filename;

        $path = Storage::disk('s3')->put($pathUrl.'/'.$filename, $img->getEncoded());

        return $pathUrl.'/'.$filename;
    } catch (\Exception $ex) {
    }
}

function download_s3_image_resize_store($path_url, $image_url, $width = null, $height = null)
{
    $fileContents = Storage::disk('s3')->get($image_url);
    $img = \Image::make($fileContents)
        ->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->encode('jpg', 75);

    $filename = uniqid().'.jpg';
    Storage::disk('s3')->put($path_url.'/'.$filename, $img);

    return $path_url.'/'.$filename;
}

function asset_s3($url)
{
    return Storage::disk('s3')->url($url);
}

function deleteS3Image($pathUrl)
{
    try {
        Storage::disk('s3')->delete($pathUrl);
    } catch (\Exception $ex) {

    }
}

function uploadS3Base64Image($pathUrl, $imageName, $file)
{
    try {
        $path = Storage::disk('s3')->put($pathUrl.'/'.$imageName, $file);

        return $pathUrl.'/'.$imageName;
    } catch (\Exception $ex) {

    }
}

function getYoutubeThumbnail(string $videoUrl): string
{
    // Extract the video ID from the YouTube URL
    preg_match('/(https?:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/(watch\?v=)?(.*)/', $videoUrl, $matches);
    $videoId = $matches[5] ?? null;

    if ($videoId) {
        // Construct the thumbnail URL
        return "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg";
    }

    return ''; // Return an empty string if the video ID cannot be extracted
}

function getVimeoThumbnail(string $videoUrl): string
{
    // Extract the video ID from the Vimeo URL
    preg_match('/(https?:\/\/)?(www\.)?(vimeo\.com\/)?(\d+)\/?/', $videoUrl, $matches);
    $videoId = $matches[4] ?? null;

    if ($videoId) {
        try {
            $response = HTTP::get("https://vimeo.com/api/v2/video/{$videoId}.json");

            $videoData = $response->json();

            // Check if $videoData is an array and has elements
            if (is_array($videoData) && count($videoData) > 0) {
                return $videoData[0]['thumbnail_large'] ?? '';
            } else {

            }

        } catch (Exception $e) {

        }
    }

    return '';
}
