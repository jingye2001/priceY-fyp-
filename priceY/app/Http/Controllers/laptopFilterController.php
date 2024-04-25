<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laptop;
use Illuminate\Support\Facades\Log;

class laptopFilterController extends Controller
{
    public function filter(Request $request)
    {
        $query = Laptop::query();

        if ($request->has('price_from') && $request->has('price_to')) {
            $priceFrom = $request->input('price_from');
            $priceTo = $request->input('price_to');
    
            // 使用 whereBetween 方法进行价格范围过滤
            $query->whereBetween('price', [$priceFrom, $priceTo]);
        }

        if ($request->has('manufacturer')) {
            $query->whereIn('manufacturer', $request->input('manufacturer'));
        }

        if ($request->has('process_model')) {
            $values = $request->input('process_model');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(process_model) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }
        
        if ($request->has('graphics_option')) {
            $values = $request->input('graphics_option');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(graphics) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        if ($request->has('display-tech')) {
            $values = $request->input('display-tech');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(display_technology) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        /// Screen Size Filter
        if ($request->has('screen-size-from') && $request->has('screen-size-to')) {
            $screenSizeFrom = $request->input('screen-size-from');
            $screenSizeTo = $request->input('screen-size-to');

            $query->whereRaw("CAST(REGEXP_SUBSTR(screen_size, '[0-9]+\\.?[0-9]*') AS DECIMAL(10,2)) >= ?", [$screenSizeFrom])
                ->whereRaw("CAST(REGEXP_SUBSTR(screen_size, '[0-9]+\\.?[0-9]*') AS DECIMAL(10,2)) <= ?", [$screenSizeTo]);
        }


        // Screen Resolution Filter
        if ($request->has('screen-resolution')) {
            $values = $request->input('screen-resolution');
            $formattedValues = array_map(function($value) {
                return str_replace(' ', '', $value);
            }, $values);
        
            $query->where(function($query) use ($formattedValues) {
                foreach ($formattedValues as $value) {
                    $query->orWhereRaw('LOWER(REPLACE(screen_resolution, "(", "")) LIKE ?', ['%' . strtolower($value) . '%']);
                    $query->orWhereRaw('LOWER(REPLACE(screen_resolution, ")", "")) LIKE ?', ['%' . strtolower($value) . '%']);

                }
            });
        }
        
        // Memory Filter
        if ($request->has('memory-from') && $request->has('memory-to')) {
            $memoryFrom = $request->input('memory-from');
            $memoryTo = $request->input('memory-to');

            $query->whereRaw("CAST(REGEXP_SUBSTR(memory, '[0-9]+(?=GB)') AS UNSIGNED) >= ?", [$memoryFrom])
                    ->whereRaw("CAST(REGEXP_SUBSTR(memory, '[0-9]+(?=GB)') AS UNSIGNED) <= ?", [$memoryTo]);
        }

        // Storage Filter
        if ($request->has('storage-from') && $request->has('storage-to')) {
            $storageFrom = $request->input('storage-from');
            $storageTo = $request->input('storage-to');
    
            $query->whereRaw("CAST(REGEXP_SUBSTR(storage, '[0-9]+') AS UNSIGNED) >= ?", [$storageFrom])
                    ->whereRaw("CAST(REGEXP_SUBSTR(storage, '[0-9]+') AS UNSIGNED) <= ?", [$storageTo]);
        }    

        // Operating System Filter
        if ($request->has('os')) {
            $values = $request->input('os');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(operating_system) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        // Battery Filter
        if ($request->has('battery') && is_array($request->input('battery'))) {
            $selectedBatteryRanges = $request->input('battery');
            $query->where(function ($q) use ($selectedBatteryRanges) {
                foreach ($selectedBatteryRanges as $index => $batteryRange) {
                    list($batteryFrom, $batteryTo) = explode('-', $batteryRange);
        
                    if ($index == 0) {
                        $q->whereRaw("CAST(REGEXP_SUBSTR(battery, '[0-9]+') AS UNSIGNED) >= ?", [$batteryFrom])
                          ->whereRaw("CAST(REGEXP_SUBSTR(battery, '[0-9]+') AS UNSIGNED) <= ?", [$batteryTo]);
                    } else {
                        $q->orWhere(function ($or) use ($batteryFrom, $batteryTo) {
                            $or->whereRaw("CAST(REGEXP_SUBSTR(battery, '[0-9]+') AS UNSIGNED) >= ?", [$batteryFrom])
                               ->whereRaw("CAST(REGEXP_SUBSTR(battery, '[0-9]+') AS UNSIGNED) <= ?", [$batteryTo]);
                        });
                    }
                }
            });
        }               

        // Laptop Type Filter
        // Operating System Filter
        if ($request->has('laptop-type')) {
            $values = $request->input('laptop-type');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(type) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        if ($request->has('laptop-filter')) {
            $values = $request->input('laptop-filter');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(filter) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        $laptops = $query->get();
        Log::debug('Filtered laptops:', $laptops->toArray());

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return response()->json(['laptops' => $laptops]);
        }

        // For non-AJAX requests, return the view with laptops data
        return view('laptopFilter', ['laptops' => $laptops]);
    }

    public function adminFilter(Request $request)
    {
        $query = Laptop::query();

        if ($request->has('price_from') && $request->has('price_to')) {
            $priceFrom = $request->input('price_from');
            $priceTo = $request->input('price_to');
    
            // 使用 whereBetween 方法进行价格范围过滤
            $query->whereBetween('price', [$priceFrom, $priceTo]);
        }

        if ($request->has('manufacturer')) {
            $query->whereIn('manufacturer', $request->input('manufacturer'));
        }

        if ($request->has('process_model')) {
            $values = $request->input('process_model');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(process_model) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }
        
        if ($request->has('graphics_option')) {
            $values = $request->input('graphics_option');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(graphics) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        if ($request->has('display-tech')) {
            $values = $request->input('display-tech');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(display_technology) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        // Screen Size Filter
        if ($request->has('screen-size-from') && $request->has('screen-size-to')) {
            $screenSizeFrom = $request->input('screen-size-from');
            $screenSizeTo = $request->input('screen-size-to');

            $query->whereRaw("CAST(REGEXP_SUBSTR(screen_size, '[0-9]+\\.?[0-9]*') AS DECIMAL(10,2)) >= ?", [$screenSizeFrom])
                ->whereRaw("CAST(REGEXP_SUBSTR(screen_size, '[0-9]+\\.?[0-9]*') AS DECIMAL(10,2)) <= ?", [$screenSizeTo]);
        }

        // Screen Resolution Filter
        if ($request->has('screen-resolution')) {
            $values = $request->input('screen-resolution');
            $formattedValues = array_map(function($value) {
                return str_replace(' ', '', $value);
            }, $values);
        
            $query->where(function($query) use ($formattedValues) {
                foreach ($formattedValues as $value) {
                    $query->orWhereRaw('LOWER(REPLACE(screen_resolution, "(", "")) LIKE ?', ['%' . strtolower($value) . '%']);
                    $query->orWhereRaw('LOWER(REPLACE(screen_resolution, ")", "")) LIKE ?', ['%' . strtolower($value) . '%']);

                }
            });
        }
        
        // Memory Filter
        if ($request->has('memory-from') && $request->has('memory-to')) {
            $memoryFrom = $request->input('memory-from');
            $memoryTo = $request->input('memory-to');

            $query->whereRaw("CAST(REGEXP_SUBSTR(memory, '[0-9]+(?=GB)') AS UNSIGNED) >= ?", [$memoryFrom])
                    ->whereRaw("CAST(REGEXP_SUBSTR(memory, '[0-9]+(?=GB)') AS UNSIGNED) <= ?", [$memoryTo]);
        }

        // Storage Filter
        if ($request->has('storage-from') && $request->has('storage-to')) {
            $storageFrom = $request->input('storage-from');
            $storageTo = $request->input('storage-to');
    
            $query->whereRaw("CAST(REGEXP_SUBSTR(storage, '[0-9]+') AS UNSIGNED) >= ?", [$storageFrom])
                    ->whereRaw("CAST(REGEXP_SUBSTR(storage, '[0-9]+') AS UNSIGNED) <= ?", [$storageTo]);
        }    

        // Operating System Filter
        if ($request->has('os')) {
            $values = $request->input('os');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(operating_system) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        // Battery Filter
        if ($request->has('battery') && is_array($request->input('battery'))) {
            $selectedBatteryRanges = $request->input('battery');
            $query->where(function ($q) use ($selectedBatteryRanges) {
                foreach ($selectedBatteryRanges as $index => $batteryRange) {
                    list($batteryFrom, $batteryTo) = explode('-', $batteryRange);
        
                    if ($index == 0) {
                        $q->whereRaw("CAST(REGEXP_SUBSTR(battery, '[0-9]+') AS UNSIGNED) >= ?", [$batteryFrom])
                          ->whereRaw("CAST(REGEXP_SUBSTR(battery, '[0-9]+') AS UNSIGNED) <= ?", [$batteryTo]);
                    } else {
                        $q->orWhere(function ($or) use ($batteryFrom, $batteryTo) {
                            $or->whereRaw("CAST(REGEXP_SUBSTR(battery, '[0-9]+') AS UNSIGNED) >= ?", [$batteryFrom])
                               ->whereRaw("CAST(REGEXP_SUBSTR(battery, '[0-9]+') AS UNSIGNED) <= ?", [$batteryTo]);
                        });
                    }
                }
            });
        }  

        // Laptop Type Filter
        // Operating System Filter
        if ($request->has('laptop-type')) {
            $values = $request->input('laptop-type');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(type) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        if ($request->has('laptop-filter')) {
            $values = $request->input('laptop-filter');
            $query->where(function($query) use ($values) {
                foreach ($values as $value) {
                    $query->orWhereRaw('LOWER(filter) LIKE ?', ['%' . strtolower($value) . '%']);
                }
            });
        }

        $laptops = $query->get();
        Log::debug('Filtered laptops:', $laptops->toArray());

        // Check if the request is an AJAX request
        if ($request->ajax()) {
            return response()->json(['laptops' => $laptops]);
        }

        // For non-AJAX requests, return the view with laptops data
        return view('adminLaptopFilter', ['laptops' => $laptops]);
    }
}
