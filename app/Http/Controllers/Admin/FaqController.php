<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Base\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::query()
            ->paginate();
        return success_out($faqs, true);
    }

    public function get(Faq $faq)
    {
        return success_out($faq);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:500',
        ]);

        $data['status'] = Faq::STATUS_SHOW;
        Faq::query()->create($data);
        return success_out(['message' => 'Successfully created']);
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return success_out(['message' => 'Successfully deleted']);
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'answer' => 'required|string|max:500',
            'status' => 'required|integer|in:0,1,5,10'
        ]);
        $faq->update($data);
        return success_out(['message' => 'Successfully changed']);
    }
}