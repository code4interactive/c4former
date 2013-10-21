C4Former
----------


konfiguracja
---




Własne pola
----------



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