<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoteService
{
    public function createNote(Request $request): Note
    {
        $prepared = $this->prepareData($request->validated(), $this->uploadFile($request));

        $note = Note::create($prepared);

        return $note;
    }

    public function updateNote(Note $note, Request $request): Note
    {
        $prepared = $this->prepareData($request->validated(), $this->uploadFile($request));

        $note->update($prepared);

        return $note;
    }

    public function deleteNote(Note $note): void
    {
        $this->deleteFile($note->photo);

        $note->delete();
    }

    /** Upload the photo for the note */
    protected function uploadFile(Request $request): ?string
    {
        if (!$request->hasFile('photo_file')) {
            return null;
        }

        $filePath = Storage::disk('images')
            ->putFile('photos', $request->file('photo_file'));

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