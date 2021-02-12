<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Setting;


class SocialLinks extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $data['sett'] = Setting::select('facebook', 'twitter', 'instagram', 'youtube', 'linkedin')->first();
        return view('components.social-links')->with($data);
    }
}
