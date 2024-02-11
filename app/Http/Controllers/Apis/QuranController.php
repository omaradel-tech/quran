<?php

namespace App\Http\Controllers\Apis;

use App\Http\Requests\Apis\EditionRequest;
use App\Http\Resources\AyahEditionResource;
use App\Http\Resources\EditionResource;
use App\Http\Resources\SurahResource;
use App\Http\Resources\SurahWithAyahsResource;
use App\Http\Resources\UserResource;
use App\Models\Ayah;
use App\Models\AyahEdition;
use App\Models\Edition;
use App\Models\Surah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuranController extends BaseController
{
    public function getAllEditions(Request $request)
    {
        $editions = Edition::all();

        return $this->success(EditionResource::collection($editions));
    }

    public function getAllsurahs()
    {
        $surahs = Surah::with('ayahs')->get();

        return $this->success(SurahResource::collection($surahs));
    }

    public function getSurahWithAyahs(Surah $surah, Request $request)
    {
        $surah->load(['ayahs']);

        return $this->success(new SurahWithAyahsResource($surah));
    }

    public function getEditionSurahWithAyahs(Edition $edition, Request $request)
    {
        $ayahEditions = AyahEdition::with('ayah')
                                    ->where('edition_id', $edition->id);


        if(isset($request->surah))
        {
            // if(isset($request->ayah))
            // {
            //     $ayahsIds = is_array($request->ayah) ? $request->ayah : [$request->ayah];
            // }else{
                $ayahsIds = Surah::with('ayahs')
                                    ->find($request->surah)
                                    ->ayahs
                                    ->when($request->ayah ?? false, fn($q, $ayah) => $q->where('number_in_surah', $ayah))
                                    ->pluck('id');
            // }

            $ayahEditions = $ayahEditions->whereIn('ayah_id', $ayahsIds)->get();

        }else{
            $ayahEditions = $ayahEditions->paginate($request->per_page ?? 10);
            return $ayahEditions;
        }

        return $this->success(AyahEditionResource::collection($ayahEditions));
    }

    public function searchInAyahs(Request $request)
    {
        $param = $request->input('term');

        return Surah::whereHas('ayahs', fn($query) => $query->where('textWithouttashkeel','like' ,"%{$param}%"))
                ->with(['ayahs' => fn($query) => $query->where('textWithouttashkeel','like' ,"%{$param}%")])
                ->get();
    }
}
