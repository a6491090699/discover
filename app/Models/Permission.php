<?php

namespace App\Models;

use Dcat\Admin\Models\Permission as ModelsPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Permission extends ModelsPermission
{
    protected $methods = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'PATCH',
        'OPTIONS',
        'HEAD',
    ];
    /**
     * If request should pass through the current permission.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function shouldPassThroughApi(Request $request): bool
    {
        // dump($this->http_path);
        if (!$this->http_path) {
            return false;
        }

        $method = $this->http_method;

        $matches = array_map(function ($path) use ($method) {
            if (Str::contains($path, ':')) {
                [$method, $path] = explode(':', $path);
                $method = explode(',', $method);
            }


            $path = Str::contains($path, '.') ? $path : ltrim($this->apiBasePath($path), '/');

            return compact('method', 'path');
        }, $this->http_path);
        foreach ($matches as $match) {
            if ($this->matchRequest($match, $request)) {
                return true;
            }
        }

        return false;
    }

    public function apiBasePath($path = '')
    {
        //更改
        // $prefix = '/'.trim(config('admin.route.prefix'), '/');
        $prefix = '/' . trim('api', '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix . '/' . $path;
    }
}
