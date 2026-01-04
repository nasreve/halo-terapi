<?php

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;

/**
 * Cek apakah layanan sudah dipilih
 * untuk checkbox dari halaman landing
 *
 * @param  mixed $service_id
 * @return string
 */
function checkedOrder($service_id)
{
    if (session()->has('orderVisitor')) {
        $collection = session('orderVisitor');
        if ($collection->where('service_id', $service_id)->count() > 0) {
            return "checked";
        }

        return "";
    }
}

/**
 * Cek apakah layanan sudah dipilih
 * untuk checkbox dari halaman profile terapis
 *
 * @param  string $service_name
 * @return string
 */
function checkedOrderTherapist($service_id, $username)
{
    if (session()->has('therapistOrder')) {
        $collection = session('therapistOrder');
        if ($collection->where('service_id', $service_id)->where('username', $username)->count() > 0) {
            return "checked";
        }

        return "";
    }
}

/**
 * Cek apakah layanan sudah dipilih
 * untuk checkbox dari halaman dashboard terapis
 *
 * @param  numeric $service_id
 * @return string
 */
function checkedOrderSelfTherapist($service_id)
{
    if (session()->has('therapistSelfOrder')) {
        $collection = session('therapistSelfOrder');
        if ($collection->where('service_id', $service_id)->count() > 0) {
            return "checked";
        }

        return "";
    }
}

/**
 * Cek apakah layanan sudah dipilih
 * untuk modal dari halaman landing
 *
 * @param  mixed $service_id
 * @return boolean
 */
function modalCheckOrder($service_id)
{
    if (session()->has('orderVisitor')) {
        $collection = session('orderVisitor');
        if ($collection->where('service_id', $service_id)->count() > 0) {
            return true;
        }

        return false;
    }
}

/**
 * Cek apakah layanan sudah dipilih
 * untuk modal dari halaman profile terapis
 *
 * @param  mixed $service_id
 * @return boolean
 */
function modalCheckOrderTherapist($service_id, $username)
{
    if (session()->has('therapistOrder')) {
        $collection = session('therapistOrder');
        if ($collection->where('service_id', $service_id)->where('username', $username)->count() > 0) {
            return true;
        }

        return false;
    }
}

/**
 * Cek apakah layanan sudah dipilih
 * untuk modal dari halaman dashboard terapis
 *
 * @param  mixed $service_id
 * @return boolean
 */
function modalCheckOrderSelfTherapist($service_id)
{
    if (session()->has('therapistSelfOrder')) {
        $collection = session('therapistSelfOrder');
        if ($collection->where('service_id', $service_id)->count() > 0) {
            return true;
        }

        return false;
    }
}

/**
 * Memformat tanggal
 *
 * @param  date $date
 * @param  string $format
 * @return string
 */
function formatDate($date, string $format)
{
    if ($date) {
        return Carbon::parse($date)->translatedFormat($format);
    }

    return "";
}

/**
 * Memformat tanggal
 *
 * @param  string $date
 * @param  string $fromFormat
 * @param  string $format
 * @return string
 */
function formatDateSearch($date, string $fromFormat, string $format)
{
    if ($date) {
        try {
            $date = Carbon::createFromFormat($fromFormat, $date)->format($format);
            return $date;
        } catch (\Throwable $th) {
            return "";
        }
    }

    return "";
}

/**
 * Menentukan umur berdasarkan tahun saat ini
 *
 * @param  date $date
 * @return string
 */
function ageFormat($date)
{
    if ($date) {
        return Carbon::parse($date)->diff(Carbon::now())->format('%y');
    }

    return "";
}

function getDOB($number)
{
    if ($number) {
        return now()->subYear($number)->format('%y');
    }

    return "";
}

/**
 * Memformat tanggal bedasarkan format tertentu
 *
 * @param  date $date
 * @param  string $fromFormat
 * @param  string $toformat
 * @return string
 */
function formatFromDate($date, string $fromFormat, string $toformat)
{
    if ($date) {
        return Carbon::createFromFormat($fromFormat, $date)->translatedFormat($toformat);
    }

    return "";
}

/**
 * Memformat harga ke mata uang rupiah.
 *
 * @param  string $price
 * @return void
 */
function formatPrice($price)
{
    return 'Rp ' . number_format($price, 0, ',', '.');
}

/**
 * Mengambil harga layanan berdasarkan mode fee (nominal atau persentase)
 * 
 * In NOMINAL mode: Returns Service->price
 * In PERCENTAGE mode: Returns TherapistService->rate
 *
 * @param  integer $therapist_id
 * @param  integer $service_id
 * @return integer
 */
function getServiceDisplayPrice($therapist_id, $service_id)
{
    return \App\Http\Services\FormWizardService::getTherapistRate($therapist_id, $service_id) ?? 0;
}

/**
 * Memformat angka koma dua.
 *
 * @param  string $price
 * @return void
 */
function formatNumberTwoComas($price)
{
    if (!$price) {
        return 0;
    }

    return number_format($price, 0, ',', '.');
}

/**
 * Menkonvert nama layanan ke nama kelas
 *
 * @param  string $text
 * @return string
 */
function toClassName($text)
{
    return str_replace(' ', '_', strtolower(str_replace('&', 'dan', $text)));
}

/**
 * Mempaginasi data collection
 *
 * @param  collection $items
 * @param  integer $perPage
 * @param  integer $page
 * @param  array $options
 * @return collection
 */
function paginateCollection($items, $perPage = 15, $page = null, $options = [])
{
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

    $items = $items instanceof Collection ? $items : Collection::make($items);

    return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
}

/**
 * Mengambil id terapis yang telah dipilih
 *
 * @param  integer $serviceId
 * @return numeric
 */
function selectedTherapistId($serviceId)
{
    if (session()->has('choosenTherapists')) {
        $collection = session('choosenTherapists');
        if ($collection->where('service_id', $serviceId)->first()) {
            return $collection->where('service_id', $serviceId)->first()->therapist_id;
        }

        return "";
    }
}

/**
 * Cek apakah terapis sudah dipilih
 *
 * @param  integer $therapistId
 * @param  integer $serviceId
 * @return string
 */
function selectedTherapist($therapistId, $serviceId)
{
    if (session()->has('choosenTherapists')) {
        $collection = session('choosenTherapists');
        if ($collection->where('service_id', $serviceId)->where('therapist_id', $therapistId)->first()) {
            return "checked";
        }

        return "";
    }
}

/**
 * Mengambil id kabupaten berdasarkan id layanan
 *
 * @param  numeric $id
 * @return numeric
 */
function getRegencyIdBySerivce($id)
{
    if (!session()->has('therapistRegencies')) {
        return auth()->guard('patient')->user()->regency->id;
    }

    $therapistRegencies = session('therapistRegencies');
    $therapistRegency = $therapistRegencies->where('service_id', $id)->first();

    return array_key_exists('regency_id', Arr::wrap($therapistRegency)) ? $therapistRegency['regency_id'] : auth()->guard('patient')->user()->regency->id;
}

/**
 * Mengambil nama kabupaten berdasarkan id layanan
 *
 * @param  numeric $id
 * @return string
 */
function getRegencyNameBySerivce($id)
{
    if (!session()->has('therapistRegencies')) {
        return auth()->guard('patient')->user()->regency->name;
    }

    $therapistRegencies = session('therapistRegencies');
    $therapistRegency = $therapistRegencies->where('service_id', $id)->first();

    if (array_key_exists('regency_id', Arr::wrap($therapistRegency))) {
        $regencyId = $therapistRegency['regency_id'];
        $regency = Regency::find($regencyId);

        return $regency->name;
    }

    return auth()->guard('patient')->user()->regency->name;
}

/**
 * Mengambil data kabupaten berdasarkan id provinsi
 *
 * @param  mixed $regency_id
 * @return void
 */
function getRegencyByProvinceId($province_id)
{
    return Regency::where('province_id', $province_id)->get();
}

/**
 * Mengambil data kecamatan berdasarkan id kabupaten
 *
 * @param  numeric $regency_id
 * @return void
 */
function getDistrictByRegencyId($regency_id)
{
    return District::where('regency_id', $regency_id)->get();
}

/**
 * Mengambil id kecamatan berdasarkan id layanan
 *
 * @param  numeric $id
 * @return numeric
 */
function getDistrictIdByService($id)
{
    if (!session()->has('therapistDistricts')) {
        return auth()->guard('patient')->user()->district->id;
    }

    $therapistDistricts = session('therapistDistricts');
    $therapistDistrict = $therapistDistricts->where('service_id', $id)->first();

    return array_key_exists('district_id', Arr::wrap($therapistDistrict)) ? $therapistDistrict['district_id'] : "";
}

/**
 * Mengambil halaman berdasarkan id service
 *
 * @param  numeric $service_id
 * @return numeric
 */
function getCurrentPage($service_id)
{
    if (!session()->has('servicePages')) {
        return 1;
    }

    $servicePages = session('servicePages');
    $servicePage = $servicePages->where('service_id', $service_id)->first();

    return array_key_exists('page', Arr::wrap($servicePage)) ? $servicePage['page'] : 1;
}

function getProvinceName($id)
{
    if (!$id) {
        return "";
    }

    return Province::find($id)->name;
}

function getRegencyName($id)
{
    if (!$id) {
        return "";
    }

    return Regency::find($id)->name;
}

function getDistrictName($id)
{
    if (!$id) {
        return "";
    }

    return District::find($id)->name;
}

function getServiceName($id)
{
    if (!$id) {
        return "";
    }

    return Service::find($id)->title;
}

function getDistricts($regency_id)
{
    if (!$regency_id) {
        return "";
    }

    return District::where('regency_id', $regency_id)->get();
}

function getProvinceIdByName($province_name)
{
    $data = Province::where('name', $province_name)->first();

    if ($data) {
        return $data->id;
    }
}

function getRegencyIdByName($province_id, $regency_name)
{
    $data = Regency::where([
        'province_id' => $province_id,
        'name' => $regency_name
    ])->first();

    if ($data) {
        return $data->id;
    }
}

function getDistrictIdByName($regency_id, $district_name)
{
    $data = District::where([
        'regency_id' => $regency_id,
        'name' => $district_name
    ])->first();

    if ($data) {
        return $data->id;
    }
}
