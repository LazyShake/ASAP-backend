<?php

namespace App\Http\Controllers;

use App\Models\SeoFile;
use Illuminate\Http\Request;
use App\Http\Resources\SeoFileResource;
use Illuminate\Support\Facades\Storage;


class SeoFileController extends Controller
{
    /**
     * Возвращает список SEO файлов с пагинацией.
     */
    public function index()
    {
        return SeoFileResource::collection(
            SeoFile::paginate(10)
        );
    }

    /**
     * Возвращает данные о конкретном SEO файле.
     *
     * @param int $id
     * @return SeoFileResource
     */
    public function show(int $id)
    {
        $seoFile = SeoFile::findOrFail($id);

        return new SeoFileResource($seoFile);
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

        return new SeoFileResource($seoFile);
    }

    /**
     * Удаляет SEO файл.
     */
    public function destroy(int $id)
    {
        $seoFile = SeoFile::findOrFail($id);

        // Удаляем файл с сервера
        Storage::delete($seoFile->path);

        // Удаляем запись из базы данных
        $seoFile->delete();

        return response()->json(null, 204);
    }
}
