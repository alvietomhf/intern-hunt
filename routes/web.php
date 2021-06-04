<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('sekolah')->name('sekolah.')->group(function(){
        Route::resource('tags', 'TagController')->parameters([
            'tags' => 'tag:slug'
        ]);
    });
    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::resource('biography', 'BiographyController');
    Route::resource('experience', 'ExperienceController');
    Route::resource('portfolio', 'PortfolioController');
    Route::resource('student', 'StudentController');
    Route::resource('guidance', 'GuidanceController')->parameters([
        'guidance' => 'guidance:slug'
    ]);
    Route::get('guidance/{guidance:slug}/student', 'GuidanceStudentController@index')->name('guidance_s.index');
    Route::get('guidance/{guidance:slug}/student/create', 'GuidanceStudentController@create')->name('guidance_s.create');
    Route::get('guidance/{guidance:slug}/student/{id}/profile', 'GuidanceStudentController@studentProfile')->name('guidance_s.sprofile');
    Route::get('guidance/{guidance:slug}/industry/{id}/profile', 'GuidanceStudentController@industryProfile')->name('guidance_s.iprofile');
    Route::get('guidance/{guidance:slug}/student/{id}/journal/{vacancy}', 'GuidanceStudentController@studentJournal')->name('guidance_s.journal');
    Route::get('guidance/{guidance:slug}/student/{id}/file/{vacancy}', 'GuidanceStudentController@studentFile')->name('guidance_s.sfile');
    Route::get('guidance/{guidance:slug}/industry/{id}/file/{vacancy}', 'GuidanceStudentController@industryFile')->name('guidance_s.ifile');
    Route::post('guidance/{guidance:slug}/student', 'GuidanceStudentController@store')->name('guidance_s.store');
    Route::delete('guidance/{guidance:slug}/student/{id}', 'GuidanceStudentController@destroy')->name('guidance_s.destroy');
    Route::get('vacancy/{id}/apply', 'VacancyController@getApply')->name('vacancy.getApply');
    Route::post('vacancy/{id}/apply', 'VacancyController@apply')->name('vacancy.apply');
    Route::post('vacancy/{id}/status', 'VacancyController@status')->name('vacancy.status');
    Route::post('vacancy/{id}/approval/{action}', 'VacancyController@action')->name('vacancy.action');
    Route::resource('vacancy', 'VacancyController');
    Route::resource('applicant', 'VacancyApplicantController');
    Route::get('detail/{id}/applicant', 'VacancyApplicantController@detail')->name('applicant.detail');
    Route::get('prakerin/student/temp', 'VacancyApplicantController@index_studentTemp')->name('prakerin.index_stemp');
    Route::resource('journal', 'JournalController');
    Route::resource('internship', 'InternshipController');
    Route::resource('sfile', 'SfileController');
    Route::resource('vacancy.ifile', 'IfileController');
    Route::get('prakerin/student', 'PrakerinController@index_student')->name('prakerin.index_s');
    Route::get('prakerin/industry', 'PrakerinController@index_industry')->name('prakerin.index_i');
    Route::get('prakerin/{id}/student', 'PrakerinController@show_student')->name('prakerin.show_s');
    Route::get('prakerin/{id}/teacher', 'PrakerinController@show_teacher')->name('prakerin.show_t');
    Route::get('prakerin/student/{id}/journal/{vacancy}', 'PrakerinController@show_journal')->name('prakerin.show_sjournal');
    Route::get('prakerin/student/{id}/file/{vacancy}', 'PrakerinController@show_file')->name('prakerin.show_sfile');
    Route::get('prakerin/vacancy/{id}/file', 'PrakerinController@show_ifile')->name('prakerin.show_ifile');
    Route::post('prakerin/vacancy/{id}/end', 'PrakerinController@end')->name('prakerin.end');
    Route::get('setting', 'HomeController@setting')->name('home.setting');
    Route::post('setting', 'HomeController@updateSetting')->name('home.updateSetting');
    Route::post('password', 'HomeController@updatePassword')->name('home.updatePassword');
});
