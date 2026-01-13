namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class downloadStuff extends Controller
{
    public function downloadPdf()
    {
        $filePath = public_path('Home/pdf/brosur/PL-GL-Januari-2024.pdf');
        $headers = ['Content-Type: application/pdf'];
        $fileName = 'Pricelist Greenland Bulan Januari 2024.pdf';

        return Response::download($filePath, $fileName, $headers);
    }
}