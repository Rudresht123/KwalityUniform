<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FileFactory extends Factory
{
    protected $model = File::class;

    public function definition(): array
    {
        $extension = $this->faker->randomElement(['jpg', 'png', 'pdf', 'docx']);
        $fileName = Str::random(10) . '.' . $extension;

        return [
            'file_name' => $fileName,
            'file_path' => 'test_files/' . $fileName,
            'disk' => 'public',
            'mime_type' => $this->faker->mimeType(),
            'file_size' => $this->faker->numberBetween(1024, 1048576),
            'extension' => $extension,
        ];
    }
}
