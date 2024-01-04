@component('mail::message')
# Good news!

Seems like someone found an item you lost, and shared its location with you.

The item you lost is: **{{ $tagName }}**

The coordinates of the item are:
@component('mail::panel')
{{ $latitude }}, {{ $longitude }}
@endcomponent
*Please note that the accuracy of the coordinates is about {{ $accuracy }} meters.*

@component('mail::button', ['url' => 'https://www.google.com/maps?q='.$latitude.','.$longitude])
View on Google Maps
@endcomponent

@endcomponent
