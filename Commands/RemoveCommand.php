<?php

namespace Pingpong\Modules\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class RemoveCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the specified module by given package name.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        if (is_null($this->argument('name'))) {
            $this->error("The module's name is required.");
            return;
        }

        $this->remove(
            $this->argument('name')
        );
    }

    /**
     * Remove the specified module.
     *
     * @param string $name
     */
    protected function remove($name)
    {
        return $this->laravel['modules']->findOrFail($name)->delete();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::OPTIONAL, 'The name of module to be removed.')
        );
    }

}
