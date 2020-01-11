<?php
/**
 * User: Warlof Tutsimo <loic.leuilliot@gmail.com>
 * Date: 21/12/2017
 * Time: 14:24
 */

namespace Seat\Akturis\Paps\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Seat\Kassie\Calendar\Models\Pap;
use Seat\Kassie\Calendar\Models\User;
use Seat\Kassie\Calendar\Models\Sde\InvType;
use Seat\Web\Http\Controllers\Controller;

class CharacterController extends Controller {

    public function paps_main($character_id)
    {
        $today = carbon();
        $user = User::where('id',$character_id)->first();
        $group = $user->associatedCharasterIds();

        $monthlyPaps = Pap::whereIn('character_id', $group)
            ->select('character_id', 'year', 'month', DB::raw('sum(value) as qty'))
            ->groupBy('year', 'month')
            ->get();

        $shipTypePaps = InvType::rightJoin('invGroups', 'invGroups.groupID', '=', 'invTypes.groupID')
            ->leftJoin('kassie_calendar_paps', 'ship_type_id', '=', 'typeID')
            ->where('categoryID', 6)
            ->where(function($query) use ($character_id) {
                $query->whereIn('character_id', $group);
            })
            ->select('invGroups.groupID', 'categoryID', 'groupName', DB::raw('sum(value) as qty'))
            ->groupBy('invGroups.groupID')
            ->orderBy('groupName')
            ->get();

        $weeklyRanking = Pap::where('week', $today->weekOfMonth)
                         ->where('month', $today->month)
                         ->where('year', $today->year)
                         ->with('user')
                         ->select('character_id', DB::raw('sum(value) as qty'))
                         ->groupBy('character_id')
                         ->orderBy('qty', 'desc')
                         ->get();

        $monthlyRanking = Pap::where('month', $today->month)
                          ->where('year', $today->year)
                          ->select('character_id', DB::raw('sum(value) as qty'))
                          ->groupBy('character_id')
                          ->orderBy('qty', 'desc')
                          ->get();

        $yearlyRanking = Pap::where('year', $today->year)
                         ->select('character_id', DB::raw('sum(value) as qty'))
                         ->groupBy('character_id')
                         ->orderBy('qty', 'desc')
                         ->get();

        return view('calendar::character.paps', compact('monthlyPaps', 'shipTypePaps',
            'weeklyRanking', 'monthlyRanking', 'yearlyRanking', 'character_id'));
    }

}
