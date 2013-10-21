C4Former
----------


konfiguracja
---




Własne pola
----------

Krok 1:
Utworzyć folder 'platform' w katalogu app.
W katalogu platform utworzyć ścieżkę: C4former/Elements
W katalogu umieścić swoje pliki pola z namespace:

```php
namespace platform\C4former\Elements;

use Code4\C4former\BaseElement;
use Code4\C4former\ElementInterface;

class testfield extends BaseElement implements ElementInterface {
    protected $type = "testfield";
    public function render() {}
}
```

Krok 2:
Dodać do composer.json wpis w autoload:

```php
"autoload": {
    "classmap": [
        ...
        ...
        "app/platform"
    ]
},
```

Wykonać composer dump_autoload za każdym razem kiedy utworzy się nowy plik z elementem formularza

Krok 3:
GOTOWE!! W ten sam sposób można nadpisywać istniejące pola formularza.


Field Methods
----------

setCustom($attributes);
Ustawia customowe dane dla danego pola. Np jeśli tworzymy własne pola i potrzebujemy zapisać w konfigu specyficzne ustawienia
np:
```php
//W konfiguracji
array(
    'id'=>'identyfikator',
    'type'=>'myField',
    'label'=>'Moje pole',
    'attributes'=> array(
        'data-format'=>'dd.mm.YYYY',
        'data-placeholder'=>'__.__.____'
    )
)

//Lub metodą:
$form->myField('identyfikator')->setCustom(array('data-format'=>'dd.mm.YYYY','data-placeholder'=>'__.__.____'));

```








Walidacja
----------


```php
$myForm = \C4Former::getNewInstance();
$myForm->load("configName");

//Własne walidacje:
if (someValue == false) $myForm->throwError('id_pola', 'komunikat');

if ($myForm->validate()) {
    //form przeszedł walidacje
} else {
    return $myForm->response();
}

//Ewentualnie w każdej chwili po wykonaniu validate() można:
if ($myForm->isValid()) {  }

```