<?php

namespace App\Actions;

use App\Models\Registrant;
use Illuminate\Http\Request;

class NaiveBayesAction
{
    public function simulate(Request $request)
    {
        $request->validate([
            'city' => 'required',
            'school' => 'required',
            'major' => 'required',
            'mean_smt_4' => 'required',
            'mean_smt_5' => 'required',
        ]);

        // Implement Naive Bayes Algorithm
        $totalData = Registrant::query()->count();
        $totalGraduated = Registrant::query()->where('status', Registrant::STATUS_GRADUATED)->count();
        $totalNotGraduated = Registrant::query()->where('status', Registrant::STATUS_NOT_GRADUATED)->count();
        $totalSelectedCityGraduated = Registrant::query()->where('city', $request->city)->where('status', Registrant::STATUS_GRADUATED)->count();
        $totalSelectedCityNotGraduated = Registrant::query()->where('city', $request->city)->where('status', Registrant::STATUS_NOT_GRADUATED)->count();
        $totalSelectedSchoolGraduated = Registrant::query()->where('school', $request->school)->where('status', Registrant::STATUS_GRADUATED)->count();
        $totalSelectedSchoolNotGraduated = Registrant::query()->where('school', $request->school)->where('status', Registrant::STATUS_NOT_GRADUATED)->count();
        $totalSelectedMajorGraduated = Registrant::query()->where('major', $request->major)->where('status', Registrant::STATUS_GRADUATED)->count();
        $totalSelectedMajorNotGraduated = Registrant::query()->where('major', $request->major)->where('status', Registrant::STATUS_NOT_GRADUATED)->count();
        $totalSelectedMeanSmt4Graduated = Registrant::query()->where('mean_smt_4', '>=', $request->mean_smt_4)->where('status', Registrant::STATUS_GRADUATED)->count();
        $totalSelectedMeanSmt4NotGraduated = Registrant::query()->where('mean_smt_4', '>=', $request->mean_smt_4)->where('status', Registrant::STATUS_NOT_GRADUATED)->count();
        $totalSelectedMeanSmt5Graduated = Registrant::query()->where('mean_smt_5', '>=', $request->mean_smt_5)->where('status', Registrant::STATUS_GRADUATED)->count();
        $totalSelectedMeanSmt5NotGraduated = Registrant::query()->where('mean_smt_5', '>=', $request->mean_smt_5)->where('status', Registrant::STATUS_NOT_GRADUATED)->count();

        $pGraduated = round($totalGraduated / $totalData, 4);
        $pNotGraduated = round($totalNotGraduated / $totalData, 4);

        $pCityGraduated = round($totalSelectedCityGraduated / $totalGraduated, 4);
        $pCityNotGraduated = round($totalSelectedCityNotGraduated / $totalNotGraduated, 4);

        $pSchoolGraduated = round($totalSelectedSchoolGraduated / $totalGraduated, 4);
        $pSchoolNotGraduated = round($totalSelectedSchoolNotGraduated / $totalNotGraduated, 4);

        $pMajorGraduated = round($totalSelectedMajorGraduated / $totalGraduated, 4);
        $pMajorNotGraduated = round($totalSelectedMajorNotGraduated / $totalNotGraduated, 4);

        $pMeanSmt4Graduated = round($totalSelectedMeanSmt4Graduated / $totalGraduated, 4);
        $pMeanSmt4NotGraduated = round($totalSelectedMeanSmt4NotGraduated / $totalNotGraduated, 4);

        $pMeanSmt5Graduated = round($totalSelectedMeanSmt5Graduated / $totalGraduated, 4);
        $pMeanSmt5NotGraduated = round($totalSelectedMeanSmt5NotGraduated / $totalNotGraduated, 4);

        $pGraduatedCitySchoolMajor = round($pGraduated * $pCityGraduated * $pSchoolGraduated * $pMajorGraduated * $pMeanSmt4Graduated * $pMeanSmt5Graduated, 7);
        $pNotGraduatedCitySchoolMajor = round($pNotGraduated * $pCityNotGraduated * $pSchoolNotGraduated * $pMajorNotGraduated * $pMeanSmt4NotGraduated * $pMeanSmt5NotGraduated, 7);

        $determineStatus = $pGraduatedCitySchoolMajor > $pNotGraduatedCitySchoolMajor ? Registrant::STATUS_GRADUATED : Registrant::STATUS_NOT_GRADUATED;

        return collect([
            'selected_city' => $request->input('city'),
            'selected_school' => $request->input('school'),
            'selected_major' => $request->input('major'),
            'mean_smt_4' => $request->input('mean_smt_4'),
            'mean_smt_5' => $request->input('mean_smt_5'),
            'total_data' => $totalData,
            'total_graduated' => $totalGraduated,
            'total_not_graduated' => $totalNotGraduated,
            'total_selected_city_graduated' => $totalSelectedCityGraduated,
            'total_selected_city_not_graduated' => $totalSelectedCityNotGraduated,
            'total_selected_school_graduated' => $totalSelectedSchoolGraduated,
            'total_selected_school_not_graduated' => $totalSelectedSchoolNotGraduated,
            'total_selected_major_graduated' => $totalSelectedMajorGraduated,
            'total_selected_major_not_graduated' => $totalSelectedMajorNotGraduated,
            'total_selected_mean_smt_4_graduated' => $totalSelectedMeanSmt4Graduated,
            'total_selected_mean_smt_4_not_graduated' => $totalSelectedMeanSmt4NotGraduated,
            'total_selected_mean_smt_5_graduated' => $totalSelectedMeanSmt5Graduated,
            'total_selected_mean_smt_5_not_graduated' => $totalSelectedMeanSmt5NotGraduated,
            'p_graduated' => $pGraduated,
            'p_not_graduated' => $pNotGraduated,
            'p_city_graduated' => $pCityGraduated,
            'p_city_not_graduated' => $pCityNotGraduated,
            'p_school_graduated' => $pSchoolGraduated,
            'p_school_not_graduated' => $pSchoolNotGraduated,
            'p_major_graduated' => $pMajorGraduated,
            'p_major_not_graduated' => $pMajorNotGraduated,
            'p_mean_smt_4_graduated' => $pMeanSmt4Graduated,
            'p_mean_smt_4_not_graduated' => $pMeanSmt4NotGraduated,
            'p_mean_smt_5_graduated' => $pMeanSmt5Graduated,
            'p_mean_smt_5_not_graduated' => $pMeanSmt5NotGraduated,
            'p_graduated_city_school_major' => $pGraduatedCitySchoolMajor,
            'p_not_graduated_city_school_major' => $pNotGraduatedCitySchoolMajor,
            'status' => $determineStatus
        ]);
    }
}
