<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Informasi;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Testimoni;
use App\Models\User;
use App\Models\Product;
use App\Models\Merek;
use Illuminate\Support\Facades\Session; // Import Session facade
use Illuminate\Support\Facades\Http; // Tambahkan ini untuk memanggil API reCAPTCHA
use Illuminate\Validation\ValidationException; // Tambahkan ini untuk menangani exception validasi


class HomeController extends Controller
{
    public function index()
    {
        // Mengambil 7 artikel terbaru, termasuk relasi user dan category
        $articles = Article::with(['user', 'category'])->where('status', true)->latest()->limit(7)->get();
        $sidebar = Informasi::latest()->limit(5)->get();
        $products = product::where('status', true)->limit(4)->latest()->get();
        $categories = Category::all();

        return view('home.main', compact('articles', 'categories', 'sidebar', 'products'));
    }

    // controller untuk article
    public function articles(Request $request)
    {
        $query = Article::where('status', true)->latest();

        // Cek apakah ada parameter 'search' dalam request
        if ($request->has('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi pencarian berdasarkan nama atau email
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil hasil paginasi
        $articles = $query->paginate(6);

        $categories = Category::all();
        $sidebar = Informasi::latest()->limit(5)->get();

        return view('home.articles.index', compact('articles', 'categories', 'sidebar'));
    }

    public function articlesShow($slug)
    {
        $articles = Article::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $sidebar = Informasi::latest()->limit(5)->get();

        return view('home.articles.show', compact('articles', 'categories', 'sidebar'));
    }
    
    public function informasi(Request $request)
    {
        $query = Informasi::where('status', true)->latest();

        // Cek apakah ada parameter 'search' dalam request
        if ($request->has('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi pencarian berdasarkan nama atau email
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil hasil paginasi
        $information = $query->paginate(6);

        $categories = Category::all();
        $sidebar = Article::latest()->limit(5)->get();

        return view('home.informasi.index', compact('information', 'categories', 'sidebar'));
    }

    public function informasiShow($slug)
    {
        $informasi = Informasi::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $sidebar = Article::latest()->limit(5)->get();

        return view('home.informasi.show', compact('informasi', 'categories', 'sidebar'));
    }

    public function articlesCategories($categoryId)
    {
        // Mengambil artikel yang memiliki category_id yang sesuai
        $articles = Article::where('category_id', $categoryId)
                           ->where('status', true)
                           ->latest()
                           ->paginate(8);

        $categories = Category::all();
        $sidebar = Informasi::latest()->limit(5)->get();

        return view('home.articles.index', compact('articles', 'categories', 'sidebar'));
    }
     public function contact()
    {
        return view('home.page.contact');
    }

    public function contactStore(Request $request)
    {
        // Validasi data yang masuk dari form, termasuk reCAPTCHA
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            // Aturan validasi untuk reCAPTCHA,
            'g-recaptcha-response' => 'required',
        ],
        [
            'g-recaptcha-response.required' => 'Silakan verifikasi bahwa Anda bukan robot.',
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.recaptcha.secret'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $body = json_decode((string)$response->body());

        if (!isset($body->success) || !$body->success) {
            // Jika verifikasi reCAPTCHA gagal
            throw ValidationException::withMessages([
                'g-recaptcha-response' => 'Verifikasi reCAPTCHA gagal. Silakan coba lagi.',
            ]);
        }

        try {
            // Simpan data ke database menggunakan model Contact
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);

            // Redirect kembali dengan pesan sukses
            Session::flash('success', 'Pesan Anda telah berhasil dikirim!');
            return redirect()->back();
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            Session::flash('error', 'Terjadi kesalahan saat mengirim pesan: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
        
    }

        public function team(Request $request)    

    { 
        $team = User::where('role', 'author', 'admin')->latest()->paginate(9);
        $categories = Category::all();
        $sidebar = Article::latest()->limit(5)->get();

        return view('home.page.team', compact('team', 'categories', 'sidebar'));
    }

        public function testimoni(Request $request)
    {
        $testimoni = Testimoni::latest()->get();
        return view('frontend.testimoni', compact('testimoni'));
    }

    // controller untuk article
 // controller untuk product
    public function product(Request $request)
    {
        $query = product::where('status', true)->latest();

        // Cek apakah ada parameter 'search' dalam request
        if ($request->has('search')) {
            $searchTerm = $request->search;
            // Tambahkan kondisi pencarian berdasarkan nama atau email
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil hasil paginasi
        $products = $query->paginate(8);

        $categories = Category::all();
        $sidebar = Informasi::latest()->limit(5)->get();

        return view('home.product.index', compact('products', 'categories', 'sidebar'));
    }

    public function productShow($slug)
    {
        // Mengambil produk utama berdasarkan slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Mengambil produk terkait berdasarkan type_id yang sama
        // dan mengecualikan produk yang sedang ditampilkan
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id) // Pastikan produk yang sedang dilihat tidak ikut
            ->inRandomOrder() // Ambil secara acak
            ->limit(3) // Batasi hingga 3 produk terkait
            ->get();

            $finalPrice = $product->price - ($product->discount ?? 0);

        // Mengirimkan semua data ke view
        return view('home.product.show', compact('product', 'relatedProducts', 'finalPrice'));
    }

    public function productsTypes($merekId)
    {
        // Mengambil artikel yang memiliki type_id yang sesuai
        $products = Product::where('type_id', $merekId)
            ->where('status', true)
            ->latest()
            ->paginate(8);

        $types = Merek::all();
        $sidebar = Informasi::latest()->limit(5)->get();

        return view('home.product.index', compact('products', 'merek', 'sidebar'));
    }
    
    
}


