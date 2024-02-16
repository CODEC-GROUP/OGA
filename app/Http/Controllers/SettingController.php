<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Resources\SettingResource;
use App\Http\Requests\UpdateSettingRequest;

class SettingController extends Controller
{

    /**
     * Display the specified setting.
     *
     * @param Setting $setting
     * @return SettingResource
     */
    public function show(Setting $setting)
    {
        return new SettingResource($setting);
    }


    /**
     * Update the specified setting in storage.
     *
     * @param UpdateSettingRequest $request
     * @param Setting $setting
     * @return SettingResource
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $validated = $request->validated();
        $setting->update($validated);
        return new SettingResource($setting);
    }
}
