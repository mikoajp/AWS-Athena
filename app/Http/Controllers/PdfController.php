<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Post;

class PdfController extends Controller
{
    public function generatePdf()
    {
        // Fetch posts from the database
        $posts = Post::all();

        // Generate the PDF using a Blade template
        $pdf = Pdf::loadView('pdf.posts', compact('posts'));

        // Stream the PDF directly to the browser for download
        return $pdf->download('posts_list.pdf');
    }
}
