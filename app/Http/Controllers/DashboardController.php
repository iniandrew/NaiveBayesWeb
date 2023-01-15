<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('Dashboard', $this->getStatistic());
    }

    public function getStatistic(): array
    {
        $query = Registrant::query();

        $statisticByCity = $query->get()->groupBy('city')->map(function ($registrant) {
            return [
                'graduated' => $registrant->where('status', Registrant::STATUS_GRADUATED)->count(),
                'not_graduated' => $registrant->where('status', Registrant::STATUS_NOT_GRADUATED)->count(),
            ];
        });

        $statisticBySchool = $query->get()->groupBy('school')->map(function ($registrant) {
            return [
                'graduated' => $registrant->where('status', Registrant::STATUS_GRADUATED)->count(),
                'not_graduated' => $registrant->where('status', Registrant::STATUS_NOT_GRADUATED)->count(),
            ];
        });

        $statisticByMajor = $query->get()->groupBy('major')->map(function ($registrant) {
            return [
                'graduated' => $registrant->where('status', Registrant::STATUS_GRADUATED)->count(),
                'not_graduated' => $registrant->where('status', Registrant::STATUS_NOT_GRADUATED)->count(),
            ];
        });

        return [
            'statistics' => [
                'filterByCity' => $statisticByCity,
                'filterBySchool' => $statisticBySchool,
                'filterByMajor' => $statisticByMajor,
            ]
        ];
    }
}
