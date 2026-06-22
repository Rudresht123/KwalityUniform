<?php

use App\Models\File;
use App\Models\NotificationTemplate;
use App\Models\RolePermission\Role;
use App\Notifications\SystemNotification;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Repositories\GlobalSettingRepo;
use Illuminate\Support\Facades\Notification;

if (!function_exists('formateDate')) {
    /**
     * Format date
     *
     * @param mixed $date
     * @param string $format
     * @return string|null
     */
    function formateDate($date, string $format = 'd M Y')
    {
        if (empty($date)) {
            return null;
        }

        try {
            return \Carbon\Carbon::parse($date)->format($format);
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Upload file to storage.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param string|null $customName
     * @param string $disk
     * @return string
     */
    if (!function_exists('uploadFile')) {
        function uploadFile(UploadedFile $file, string $folder, ?string $customName = null, string $disk = 'public'): int
        {
            $extension = $file->getClientOriginalExtension();

            $fileName = $customName ? $customName . '.' . $extension : Str::uuid() . '.' . $extension;

            $path = $file->storeAs($folder, $fileName, $disk);

            $uploadedFile = \App\Models\File::create([
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'disk' => $disk,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'extension' => $extension,
            ]);

            return $uploadedFile->id;
        }
    }

    if (!function_exists('getFileUrl')) {
        function getFileUrl($fileId, string $default = 'images/no_image.png'): string
        {
            if (!$fileId) {
                return asset($default);
            }
            $file = File::find($fileId);
            if (!$file) {
                return asset($default);
            }

            return $file->url;
        }
    }

    /**
     * Getting Organization Types Records
     */
}

if (!function_exists('deleteFile')) {
    function deleteFile(?string $path, string $disk = 'public'): bool
    {
        if (!$path) {
            return false;
        }

        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }

        return false;
    }
}

if (!function_exists('role')) {
    function role($search)
    {
        return Role::where($search)->first()->id;
    }
}

if (!function_exists('emailButton')) {
    function emailButton(string $url, string $text): string
    {
        return "
<a href='{$url}'
   style='
    background:#6B62DD;
    color:#ffffff;
    text-decoration:none;
    padding:14px 28px;
    border-radius:10px;
    display:inline-block;
    font-weight:600;
    font-size:14px;
   '>
   {$text} &nbsp;→
</a>";
    }

    if (!function_exists('sendNotification')) {
        function sendNotification($users, string $key, array $placeholders = [], ?string $url = null)
        {
            $template = NotificationTemplate::where('key', $key)->firstOrFail();

            $message = $template->message;

            foreach ($placeholders as $placeholder => $value) {
                $message = str_replace('{' . $placeholder . '}', $value, $message);
            }

            Notification::send(
                $users,
                new SystemNotification(
                    [
                        'key' => $key,
                        'title' => $template->title,
                        'message' => $message,
                        'type' => $template->type,
                        'url' => $url,
                        'created_at' => now(),
                    ],
                    $template->channels,
                ),
            );
        }
    }
}

?>
