<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\ApiController;
use App\ActionsHistory;
use App\Module;
use App\RoleRight;

class ThemeController extends ApiController
{
    const THEME_RED = 1;
    const THEME_DARK_RED = 2;
    const THEME_LIGHT_BLUE = 3;
    const THEME_BLUE = 4;
    const THEME_DARK_BLUE = 5;
    const THEME_LIGHT_GREEN = 6;
    const THEME_GREEN = 7;
    const THEME_YELLOW = 8;
    const THEME_ORANGE = 9;
    const THEME_PURPLE = 10;

    public static function getThemes()
    {
        return [
            self::THEME_RED         => __('custom.red'),
            self::THEME_DARK_RED    => __('custom.dark_red'),
            self::THEME_LIGHT_BLUE  => __('custom.light_blue'),
            self::THEME_BLUE        => __('custom.blue'),
            self::THEME_DARK_BLUE   => __('custom.dark_blue'),
            self::THEME_LIGHT_GREEN => __('custom.light_green'),
            self::THEME_GREEN       => __('custom.green'),
            self::THEME_YELLOW      => __('custom.yellow'),
            self::THEME_ORANGE      => __('custom.orange'),
            self::THEME_PURPLE      => __('custom.purple'),
        ];
    }

    public static function getThemeColors()
    {
        return [
            self::THEME_RED         => '#d32a31',
            self::THEME_DARK_RED    => '#c02e54',
            self::THEME_LIGHT_BLUE  => '#108f9e',
            self::THEME_BLUE        => '#4e57aa',
            self::THEME_DARK_BLUE   => '#145c99',
            self::THEME_LIGHT_GREEN => '#76ad3f',
            self::THEME_GREEN       => '#0a7b5d',
            self::THEME_YELLOW      => '#e8d429',
            self::THEME_ORANGE      => '#e98911',
            self::THEME_PURPLE      => '#791292',
        ];
    }

    public static function getThemeClasses()
    {
        return [
            self::THEME_RED         => 'data-attention',
            self::THEME_DARK_RED    => 'index',
            self::THEME_LIGHT_BLUE  => 'user',
            self::THEME_BLUE        => 'data',
            self::THEME_DARK_BLUE   => 'document',
            self::THEME_LIGHT_GREEN => 'organisation',
            self::THEME_GREEN       => 'news',
            self::THEME_YELLOW      => 'request',
            self::THEME_ORANGE      => 'visualisation',
            self::THEME_PURPLE      => 'contact',
        ];
    }

    /**
     * API function for themes
     *
     * @param string api_key - required
     *
     * @return JsonResponse - JSON containing: On success - Status 200 list of themes / On fail - Status 500 error message
     */
    public function listThemes(Request $request)
    {
        $rightCheck = RoleRight::checkUserRight(
            Module::THEMES,
            RoleRight::RIGHT_VIEW
        );

        if (!$rightCheck) {
            return $this->errorResponse(__('custom.access_denied'));
        }

        $themeNames = $this->getThemes();
        foreach ($themeNames as $id => $themeName) {
            $themes[] = [
                'id'    => $id,
                'name'  => $themeName,
            ];
        }
        $logData = [
            'module_name'      => Module::getModuleName(Module::THEMES),
            'action'           => ActionsHistory::TYPE_SEE,
            'action_msg'       => 'Listed themes',
        ];

        Module::add($logData);

        return $this->successResponse($themes);
    }
}
