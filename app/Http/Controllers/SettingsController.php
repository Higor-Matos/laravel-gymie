<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $settings = \Utilities::getSettings();

        return view('settings.show', compact('settings'));
    }

    public function edit()
    {
        $settings = \Utilities::getSettings();

        return view('settings.edit', compact('settings'));
    }

    public function save(Request $request)
    {
        // Get All Inputs Except '_Token' to loop through and save
        $settings = $request->except('_token');

        // Create an instance of ImageManager with GD driver
        $manager = new ImageManager(['driver' => 'gd']);

        // Update All Settings
        foreach ($settings as $key => $value) {
            try {
                if ($key == 'gym_logo' && $request->hasFile('gym_logo')) {
                    $file = $request->file('gym_logo');
                    
                    try {
                        // Process the image
                        $image = $manager->make($file->getRealPath());
                        
                        // Save the image
                        $image->encode('jpg', 75)->save(public_path('/assets/img/gym/gym_logo.jpg'));

                        // Set the value to the file name for the database
                        $value = 'gym_logo.jpg';
                    } catch (\Exception $e) {
                        return back()->withErrors(['gym_logo' => 'Erro ao processar a imagem: ' . $e->getMessage()]);
                    }
                }

                // Parse dates if necessary
                if (in_array($key, ['financial_start', 'financial_end'])) {
                    if (empty($value)) {
                        throw new \InvalidArgumentException("Data missing");
                    }
                    $value = \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
                }

                Setting::where('key', '=', $key)->update(['value' => $value]);
            } catch (\Exception $e) {
                return back()->withErrors(['error' => 'Whoops, looks like something went wrong.']);
            }
        }

        flash()->success('Configurações foram atualizadas com sucesso');

        return redirect('settings/edit');
    }

}
