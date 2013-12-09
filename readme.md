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

Nowa metoda Validate pozwala na exludowanie i includowanie pól do walidacji:

```php
//Walidacja jednego pola:
$myForm->validate('user');

//Walidacja wielu pól:
$myForm->validate('user,email,pass');
$myForm->validate(array('user','email','pass'));

$myForm->validate('include', 'user');
$myForm->validate('include', 'user,email,pass');
$myForm->validate('include', array('user','email','pass'));

//Wykluczenie z walidacji
$myForm->validate('!user');
$myForm->validate('!user,!email,!pass');
$myForm->validate(array('!user','!email','!pass'));

$myForm->validate('exclude', 'user');
$myForm->validate('exclude', 'user,email,pass');
$myForm->validate('exclude', array('user','email','pass'));

```




Renderowanie
----------


```php
$myForm = \C4Former::getNewInstance();
$myForm->load("configName");

//Renderowanie całości:
$myForm->render();


//Renderowanie od początku formularza do elementu:
$myForm->renderTo('id_pola');


//Renderowanie od elementu do końca formularza:
$myForm->renderFrom('id_pola');


//Renderowanie częściowe:
$myForm->renderFromTo('id_od', 'id_do');

```

