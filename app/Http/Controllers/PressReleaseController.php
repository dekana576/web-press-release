<?php

namespace App\Http\Controllers;

use App\Models\PressRelease;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PressReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function index(Request $request)
{
    // Ambil bulan dan tahun dari request, jika tidak ada default ke semua bulan dan tahun sekarang
    $year = $request->input('year', 'all');
    $month = $request->input('month', 'all');

    // Query press release berdasarkan filter tahun dan bulan
    $query = PressRelease::query();

    // Filter tahun jika tahun dipilih, jika 'all' maka semua tahun
    if ($year !== 'all') {
        $query->whereYear('created_at', $year);
    }

    // Filter bulan jika bulan dipilih, jika 'all' maka semua bulan
    if ($month !== 'all') {
        $query->whereMonth('created_at', $month);
    }

    // Hitung total press release berdasarkan filter
    $totalPressRelease = $query->count();

    // Ambil semua press release yang difilter
    $pressReleases = $query->get();

    // Hitung jumlah total link dari semua press release yang telah difilter
    $pressReleaseWithLink = $pressReleases->sum(function ($pressRelease) {
        return ($pressRelease->link_kabarnusa ? 1 : 0) +
            ($pressRelease->link_baliportal ? 1 : 0) +
            ($pressRelease->link_updatebali ? 1 : 0) +
            ($pressRelease->link_pancarpos ? 1 : 0) +
            ($pressRelease->link_wartadewata ? 1 : 0) +
            ($pressRelease->link_baliexpress ? 1 : 0) +
            ($pressRelease->link_fajarbali ? 1 : 0) +
            ($pressRelease->link_balitribune ? 1 : 0) +
            ($pressRelease->link_radarbali ? 1 : 0) +
            ($pressRelease->link_dutabali ? 1 : 0) +
            ($pressRelease->link_baliekbis ? 1 : 0);
    });

    // Jika bulan diset ke "all", hitung link per bulan untuk tahun yang dipilih (atau semua tahun jika 'all')
    $linksPerMonth = [];
    $pressReleasePerMonth = [];

    if ($month === 'all') {
        // Ambil jumlah link per bulan
        $linksPerMonth = PressRelease::selectRaw('MONTH(created_at) as month, SUM(
            (link_kabarnusa IS NOT NULL) +
            (link_baliportal IS NOT NULL) +
            (link_updatebali IS NOT NULL) +
            (link_pancarpos IS NOT NULL) +
            (link_wartadewata IS NOT NULL) +
            (link_baliexpress IS NOT NULL) +
            (link_fajarbali IS NOT NULL) +
            (link_balitribune IS NOT NULL) +
            (link_radarbali IS NOT NULL) +
            (link_dutabali IS NOT NULL) +
            (link_baliekbis IS NOT NULL)
        ) as total_links')
        ->when($year !== 'all', function ($query) use ($year) {
            $query->whereYear('created_at', $year);
        })
        ->groupByRaw('MONTH(created_at)')
        ->pluck('total_links', 'month')
        ->toArray();

        // Hitung jumlah press release per bulan
        $pressReleasePerMonth = PressRelease::selectRaw('MONTH(created_at) as month, COUNT(*) as total_press_releases')
            ->when($year !== 'all', function ($query) use ($year) {
                $query->whereYear('created_at', $year);
            })
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total_press_releases', 'month')
            ->toArray();
    } else {
        // Jika bulan spesifik dipilih, hanya tampilkan link untuk bulan tersebut
        $pressReleasesForMonth = $query->get();
        $linksPerMonth[(int)$month] = $pressReleasesForMonth->sum(function ($pressRelease) {
            return ($pressRelease->link_kabarnusa ? 1 : 0) +
                ($pressRelease->link_baliportal ? 1 : 0) +
                ($pressRelease->link_updatebali ? 1 : 0) +
                ($pressRelease->link_pancarpos ? 1 : 0) +
                ($pressRelease->link_wartadewata ? 1 : 0) +
                ($pressRelease->link_baliexpress ? 1 : 0) +
                ($pressRelease->link_fajarbali ? 1 : 0) +
                ($pressRelease->link_balitribune ? 1 : 0) +
                ($pressRelease->link_radarbali ? 1 : 0) +
                ($pressRelease->link_dutabali ? 1 : 0) +
                ($pressRelease->link_baliekbis ? 1 : 0);
        });

        // Hitung jumlah press release untuk bulan tersebut
        $pressReleasePerMonth[(int)$month] = $pressReleasesForMonth->count();
    }

    // Inisialisasi array untuk semua bulan jika filter bulan adalah 'all'
    $fullMonthData = array_fill(1, 12, 0); // Isi dengan 0 untuk setiap bulan
    $fullPressReleaseData = array_fill(1, 12, 0); // Isi dengan 0 untuk setiap bulan

    foreach ($linksPerMonth as $monthKey => $totalLinks) {
        $fullMonthData[$monthKey] = $totalLinks;
    }

    foreach ($pressReleasePerMonth as $monthKey => $totalPressReleases) {
        $fullPressReleaseData[$monthKey] = $totalPressReleases;
    }

    // Ambil daftar tahun yang tersedia di database untuk opsi filter
    $availableYears = PressRelease::selectRaw('YEAR(created_at) as year')
                                ->distinct()
                                ->pluck('year');

    // Kirim data ke view
    return view('dashboard', compact('totalPressRelease', 'pressReleaseWithLink', 'fullMonthData', 'fullPressReleaseData', 'year', 'month', 'availableYears'));
}

     


    public function pressIndex()
    {
        return view('press_release');
    }


    public function getPress(Request $request)
    {
        $press = PressRelease::query();

        // Filter berdasarkan bulan
        if ($request->has('month') && !empty($request->month)) {
            $press->whereMonth('created_at', $request->month);
        }

        // Filter berdasarkan pencarian global
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $press->where(function ($query) use ($searchValue) {
                $query->where('press_name', 'like', "%{$searchValue}%")
                    ->orWhere('description', 'like', "%{$searchValue}%");
            });
        }

        // Urutkan data dari yang terbaru
        $press->orderBy('created_at', 'desc');

        return DataTables::of($press)
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d-m-Y'); // Menampilkan hanya tanggal
            })
            ->editColumn('press_name', function ($row) {
                $maxLength = 50; // Batasi panjang karakter
                return strlen($row->press_name) > $maxLength ? substr($row->press_name, 0, $maxLength) . ' ...' : $row->press_name;
            })
            ->addColumn('action', function ($row) {
                return $row->id; // Hanya mengembalikan ID untuk frontend
            })
            ->rawColumns(['action'])
            ->make(true);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image.*' => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif', // Validate each image
    ]);

    // Handle multiple image uploads
    $imagePaths = [];
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $image) {
            // Generate unique name for the image
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Store image in 'uploads' directory within 'public' disk
            $imagePath = $image->storeAs('uploads', $imageName, 'public');

            // Store only the relative path in the array (without the full URL)
            $imagePaths[] = $imagePath; // Store path relative to 'storage/app/public'
        }
    }

    // Save press release data with the image paths stored as JSON in the database
    $pressRelease = PressRelease::create([
        'press_name' => $request->name,
        'description' => $request->description,
        'image' => json_encode($imagePaths), // Store image paths as JSON in the database
    ]);

    return redirect()->back()->with('success', 'Data added successfully with images!');
}




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $press = PressRelease::findOrFail($id);

        return view('view', compact('press'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pressRelease = PressRelease::findOrFail($id);
        return view('edit', compact('pressRelease'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'press_name' => 'required|string|max:255',
            'description' => 'required|string',
            'link_kabarnusa' => 'nullable|url',
            'link_baliportal' => 'nullable|url',
            'link_updatebali' => 'nullable|url',
            'link_pancarpos' => 'nullable|url',
            'link_wartadewata' => 'nullable|url',
            'link_baliexpress' => 'nullable|url',
            'link_fajarbali' => 'nullable|url',
            'link_balitribune' => 'nullable|url',
            'link_radarbali' => 'nullable|url',
            'link_dutabali' => 'nullable|url',
            'link_baliekbis' => 'nullable|url', 
            'link_other' => 'nullable|string',
        ]);

        $pressRelease = PressRelease::findOrFail($id);
        $pressRelease->update([
            'press_name' => $request->press_name,
            'description' => $request->description,
            'link_kabarnusa' => $request->link_kabarnusa,
            'link_baliportal' => $request->link_baliportal,
            'link_updatebali' => $request->link_updatebali,
            'link_pancarpos' => $request->link_pancarpos,
            'link_wartadewata' => $request->link_wartadewata,
            'link_baliexpress' => $request->link_baliexpress,
            'link_fajarbali' => $request->link_fajarbali,
            'link_balitribune' => $request->link_balitribune,
            'link_radarbali' => $request->link_radarbali,
            'link_dutabali' => $request->link_dutabali,
            'link_baliekbis' => $request->link_baliekbis,
            'link_other' => $request->link_other,
        ]);

        return redirect()->route('press_release')->with('success', 'Press Release updated successfully.');
  
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy($id)
    {
        // Ambil data PressRelease berdasarkan ID
        $pressRelease = PressRelease::findOrFail($id);

        // Decode gambar jika menyimpan dalam bentuk array JSON
        $images = json_decode($pressRelease->image);

        // Hapus setiap gambar dari storage
        foreach ($images as $image) {
            $imagePath = $image;

            // Cek jika gambar ada sebelum menghapusnya
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        // Hapus data press release dari database
        $pressRelease->delete();

        return response()->json(['message' => 'Data dan gambar berhasil dihapus!']);
    }


}
