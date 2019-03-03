# Vellum
Vellum is a modular component building library written in PHP loosely inspired by 
[atomic design principles](http://atomicdesign.bradfrost.com/).

```php
$renderer = new HtmlRenderer();
        
$arguments = [
    'button_text' => 'Submit',
    'classes' => 'btn btn-success',
];

$component = new \Example\Component\Button($arguments, $renderer);

echo $component->render(); // would display:
/*
<button type="submit" class="btn btn-success">
    Submit
</button>
*/
```

## Concepts
Atomic design gives the designer tools to build interfaces that work together "to create interface design systems in a more deliberate and hierarchical manner." - http://atomicdesign.bradfrost.com/chapter-2/

Similarly Vellum provides PHP interfaces that allow a designer/team to create their design system hierarchy. Vellum components can be instantiated and rendered to build UI. Finally, Vellum provides a means of explicitly declaring parameters to which each component can consume and respond.

### Component
Vellum provides `\Vellum\Contracts\AbstractComponent` to extend. The `AbstractComponent` implements several interfaces that are explained below.

### Renderers
The goal of a component is to be consumed by a user, human or otherwise. Vellum provides a means of consumption consumption via a Renderer. Vellum assumes that a component will be rendered, but it's agnostic to how it will happen.

Every component is injected with a designer-supplied Renderer (a PHP object that implements `\Vellum\Contracts\Renderers\RenderInterface`). This allows a team to choose its templating engine of choice (Twig, Plates, etc...). There is [a companion library for Twig](https://github.com/diatechnis/vellum-twig) if interested.

#### Paths
Vellum needs to know where your components are in order to instantiate and render them.
But, once again, Vellum wants to be as agnostic as possible about how and where to find them.

Vellum provides `\Vellum\Path\ClassPathInterface` and `\Vellum\Path\TemplatePathInterface` that to find component classes and templates respectively. Basic implementations reside at `\Vellum\Path\SimpleClassPathResolver` and `SimpleTemplatePathResolver`.

### Inputs
Supplying instructions to a component tells it what content to render, but what instructions can you give it? Inputs provide you with an API that determines what instructions each component expects, in what data type each instruction should be submitted, and what the default value would be if no instructions are supplied.

```php
protected function createInputs(): InputsInterface
{
    return new Inputs(
        new TextInput(
            $name = 'button_text',
            $description = 'Button Text',
            $default_value = 'Submit'
        )
    );
}
```

#### Options
Some inputs may have a discrete number of expected choices (Yes/No or 1-5). Options express those choices.

```php
protected function createInputs(): InputsInterface
{
    return new Inputs(
        new SelectOneInput(
            $name = 'open_in_new_window',
            $description = 'Open the link in a new window?',
            $supply_value_as = Formats::NUMBER,
            $options = new Options(
                new Option('Same window', 0),
                new Option('New window', 1)
            ),
            $default_value = 0
        )
    );
}
```

### Display Types
Display types are a special type of input. Some components may use the same data but can be displayed in very different ways. For example, a preview list of blog posts can be displayed using a card interface, a carousel, or as a simple `<ul>` list. It's the same blog data, but the html is very different. Let's also say that each way of displaying the data has inputs that only apply to that particular view type (e.g. slide transition speed for the carousel view). Display types allow you to define the different ways to view a component as well as inputs specific to each display.

```php
protected function createDisplayTypes(): DisplayTypesInterface
{
    return new DisplayTypes(
        new DisplayType(
            $name = 'submit',
            $inputs = new Inputs(
                new SelectOneInput(
                    'submit_via_ajax',
                    'Submit form via an ajax request?',
                    Formats::NUMBER,
                    new Options(
                        new Option('No', 0),
                        new Option('Yes', 1)
                    ),
                    0
                )
            ),
            $description = 'Submit Button',
            $default_display_type = true
        ),
        new DisplayType(
            $name = 'cancel',
            $inputs = new Inputs(
                new TextInput(
                    'confirm_message',
                    'Message to ask if user is sure',
                    'Are you sure you want to cancel this?'
                )
            ),
            $description = 'Cancel Button'
        )
    );
}
```

### Arguments
Inputs, options and display types provide the means of creating the instructions a component needs to properly render itself. The supplied instruction data gets instantiated into an Arguments object that the renderer can use to access the instructions in the template/view.

```php
$arguments = new Arguments([
    'button_text' => 'Submit',
    'classes' => 'btn btn-success',
]);

$arguments->get('button_text'); // returns 'Submit'

$arguments->get('nonexistent_key'); // returns null

$arguments->get('nonexistent_key', 'default_value'); // returns 'default_value'
```
