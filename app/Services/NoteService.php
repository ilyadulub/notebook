<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Note;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NoteService
{
    public function createNote(array $data): Note
    {
        return DB::transaction(function () use ($data) {
            $prepared = $this->prepareData($data, $this->uploadFile($data['photo_file']));

            $note = Note::create($prepared);

            return $note;
        });
    }

    public function updateNote(Note $note, array $data): Note
    {
        return DB::transaction(function () use ($note, $data) {
            $prepared = $this->prepareData($data, $this->uploadFile($data['photo_file']));

            $note->update($prepared);

            return $note;
        });
    }

    public function deleteNote(Note $note): void
    {
        DB::transaction(function () use ($note) {
            $pathToPhoto = $note->photo;

            $note->delete();

            $this->deleteFile($pathToPhoto);
        });
    }

    /** Upload the photo for the note */
    protected function uploadFile(UploadedFile $file): ?string
    {
        if (!$file) {
            return null;
        }

        $filePath = Storage::disk('images')
            ->putFile('photos', $file);

        return ($filePath !== false) ? $filePath : null;
    }

    /** Delete the photo file */
    protected function deleteFile(?string $filePath): void
    {
        Storage::disk('images')->delete($filePath);
    }

    /** Prepare data before saving into DB */
    protected function prepareData(array $data, ?string $filePath): array
    {
        return [
            'full_name' => $data['full_name'],
            'company' => $data['company'] ?? null,
            'phone' => $data['phone'],
            'email' => $data['email'],
            'birthday' => $data['birthday'] ?? null,
            'photo' => $filePath,
        ];
    }
}