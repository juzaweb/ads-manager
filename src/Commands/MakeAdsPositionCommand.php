<?php

namespace Juzaweb\AdsManager\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Juzaweb\CMS\Facades\Theme;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class MakeAdsPositionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'ads:make-position';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new ads position.';

    public function handle(): int
    {
        $name = preg_replace("/\W/", '_', $this->argument('name'));
        $name = strtolower($name);

        $themeName = $this->argument('theme');
        $theme = Theme::find($themeName);

        if ($theme === null) {
            $this->error("Theme {$themeName} does not exists.");
            return self::FAILURE;
        }

        $register = json_decode($theme->getContents('register.json'), true, 512, JSON_THROW_ON_ERROR);
        $positions = Arr::get($register, 'ads_positions', []);

        if (Arr::get($positions, $name)) {
            $this->error("Position {$name} already exists.");
            return self::FAILURE;
        }

        $positions[$name] = [
            'name' => ucwords(str_replace('_', ' ', $name)),
        ];

        if ($this->option('size')) {
            $positions[$name]['size'] = $this->option('size');
        }

        $register['ads_positions'] = $positions;

        File::put(
            $theme->getPath('register.json'),
            json_encode($register, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT)
        );

        $this->info("Position {$name} created successfully.");

        return self::SUCCESS;
    }

    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of block will be make.'],
            ['theme', InputArgument::REQUIRED, 'The name of theme.'],
        ];
    }

    protected function getOptions(): array
    {
        return [
            ['size', null, InputOption::VALUE_OPTIONAL, 'The size of position.'],
        ];
    }
}
