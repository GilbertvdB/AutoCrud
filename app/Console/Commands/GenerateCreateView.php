<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateCreateView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:viewCreate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a create view for a model';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $model = $this->argument('model');
        $model = $this->ask('Enter model name');
        $fillableProperties = $this->getFillableProperties($model);
        $inputTypes = $this->askForInputTypes($fillableProperties);
        $inputContents = $this->generateInputContents($fillableProperties, $inputTypes);

        $viewPath = resource_path("views/". Str::plural(Str::lower($model))."/create.blade.php");

        // // Check if the Blade template file already exists
        // if (!File::exists($viewPathTemplate)) {
        //     $this->generateFormViewTemplate($viewPathTemplate);
        // }

        $this->generateFormView($viewPath, Str::lower($model), $inputContents);

        $this->info("Form view generated for model: $model");
    }

    protected function getFillableProperties($model)
    {
        $modelClass = "App\\Models\\$model";

        if (!class_exists($modelClass)) {
            return [];
        }

        return (new $modelClass())->getFillable();
    }

    protected function askForInputTypes($fillableProperties)
    {
        $inputTypes = [];

        foreach ($fillableProperties as $property) {
            $inputType = $this->ask("Enter input type for $property (text/textarea/select/number/hidden/none/file)");
            $inputTypes[$property] = $inputType;
        }

        return $inputTypes;
    }

    protected function generateInputContents($fillableProperties, $inputTypes)
    {
        $inputContents = [];

        foreach ($fillableProperties as $property) {
            $inputType = $inputTypes[$property] ?? 'text';

            if ($inputType === 'none') {
                continue; // Skip properties with input type 'none'
            }

            $inputContents[$property] = $this->generateInputContent($inputType, $property);
        }

        return $inputContents;
    }

    protected function generateFormView($viewPath, $model, $inputContents)
    {
        // Read the contents of the stub file
        $stubContents = file_get_contents(__DIR__ . '/stubs/create.stub');

        // dd($inputContents);

        // Replace placeholders in the stub with actual content
        $stubContents = str_replace('{{model}}', $model, $stubContents);
        $stubContents = str_replace('{{inputContents}}', implode(PHP_EOL, $inputContents), $stubContents);

        // Write the view content to the form.blade.php file
        File::put($viewPath, $stubContents);
    }
    protected function generateInputContent($inputType, $property)
    {
        if ($inputType === 'textarea') {
            // Generate the textarea input code
            return <<<HTML

                                    <div class="form-group mb-3">
                                        <label for="$property" class="@if (\$errors->has('$property')) text-danger @endif">{{ __('labels.$property') }}</label>
                                        <textarea id="$property" name="$property" class="form-control @if (\$errors->has('$property')) is-invalid @endif"
                                            placeholder="{{ __('labels.$property') }}..." required>{{ old('$property') }}</textarea>
                                    </div>
                HTML;
        } elseif ($inputType === 'select') {
            // Generate the select input code
            return <<<HTML

                                    <div class="form-group mb-3">
                                        <label for="$property" class="@if (\$errors->has('$property')) text-danger @endif">{{ __('labels.$property') }}</label>
                                        <select id="$property" name="$property" class="form-control @if (\$errors->has('$property')) is-invalid @endif" required>
                                            <option value="">{{ __('labels.choice') }}</option>
                                            {{-- @foreach (\$options as \$option)
                                            <option value="{{ \$option->id }}">{{ \$option->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                HTML;
        } elseif ($inputType === 'hidden') {
            // Generate the hidden input code
            return <<<HTML

                                    <input type="hidden" name="$property" id="$property" value="{{ old('$property') }}">
                HTML;
        } elseif ($inputType === 'number') {
            // Generate the number input code
            return <<<HTML
                                    <div class="form-group mb-3">
                                        <label for="$property" class="@if (\$errors->has('$property')) text-danger @endif">{{ __('labels.$property') }}</label>
                                        <input type="number" id="$property" name="$property" class="form-control @if (\$errors->has('$property')) is-invalid @endif"
                                            placeholder="{{ __('labels.$property') }}..." value="{{ old('$property') }}" required>
                                    </div>
                HTML;
        } elseif ($inputType === 'file') {
            // Generate the file input code
            return <<<HTML

                                    <div class="form-group mb-3">
                                        <label for="$property" class="@if (\$errors->has('$property')) text-danger @endif">{{ __('labels.$property') }}</label>
                                        <input type="file" id="$property" name="$property" class="form-control-file @if (\$errors->has('$property')) is-invalid @endif" required>
                                    </div>
                HTML;
        }else {
            // Generate the text input code (same as before)
            return <<<HTML

                                    <div class="form-group mb-3">
                                        <label for="$property" class="@if (\$errors->has('$property')) text-danger @endif">{{ __('labels.$property') }}</label>
                                        <input type="$inputType" id="$property" name="$property" class="form-control @if (\$errors->has('$property')) is-invalid @endif"
                                            placeholder="{{ __('labels.$property') }}..." value="{{ old('$property') }}" required>
                                    </div>
                HTML;
        }
    }

}
