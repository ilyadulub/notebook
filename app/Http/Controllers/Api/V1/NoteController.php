<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\Response;
use App\Http\Requests\NoteRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NoteController extends Controller
{
    public function index(): ResourceCollection
    {
        return NoteResource::collection(Note::paginate(2));
    }

    public function store(NoteRequest $request, NoteService $noteService): JsonResource
    {
        $note = $noteService->createNote($request);

        return new NoteResource($note);
    }

    public function show(Note $note): JsonResource
    {
        return new NoteResource($note);
    }

    public function update(Note $note, NoteRequest $request, NoteService $noteService): JsonResource
    {
        $note = $noteService->updateNote($note, $request);

        return new NoteResource($note);
    }

    public function destroy(Note $note, NoteService $noteService): Response
    {
        $noteService->deleteNote($note);

        return response()->noContent();
    }
}
