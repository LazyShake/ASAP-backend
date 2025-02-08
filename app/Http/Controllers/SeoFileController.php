<?php

namespace App\Http\Controllers;

use App\Models\SeoFile;
use Illuminate\Http\Request;
use App\Http\Resources\SeoPageResource;
use Illuminate\Support\Facades\Storage;

class SeoFileController extends Controller
{
    /**
     * Возвращает список SEO файлов с пагинацией.
     */
    public function index()
    {
        $seoFiles = SeoFile::paginate(10);

        return SeoPageResource::collection($seoFiles->isEmpty() ? [] : $seoFiles);
    }

    /**
     * Возвращает данные о конкретном SEO файле.
     *
     * @param int $id
     * @return SeoPageResource
     */
    public function show(int $id)
    {
        $seoFile = SeoFile::find($id);

        if (!$seoFile) {
            return response()->json(['error' => 'SEO file not found'], 404);
        }

        return new SeoPageResource($seoFile);
    }

    /**
     * Сохраняет новый SEO файл.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:txt,pdf,doc,docx|max:2048',
        ]);

        // Сохраняем файл на сервере
        $path = $request->file('file')->store('seo-files', 'public');

        // Сохраняем информацию о файле в базе данных
        $seoFile = SeoFile::create([
            'file_name' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
        ]);

        return new SeoPageResource($seoFile);
    }

    /**
     * Удаляет SEO файл.
     */
    public function destroy(int $id)
    {
        $seoFile = SeoFile::find($id);

        if (!$seoFile) {
            return response()->json(['error' => 'SEO file not found'], 404);
        }

        // Удаляем файл с сервера
        Storage::delete($seoFile->path);

        // Удаляем запись из базы данных
        $seoFile->delete();

        return response()->json(null, 204);
    }
}
