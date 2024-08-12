 @if ($message = Session::get('primary'))
    {!! alert_html( $message, 'primary' ) !!} 
 @endif
 @if ($message = Session::get('secondary'))
    {!! alert_html( $message, 'secondary' ) !!}
 @endif
 @if ($message = Session::get('success'))
    {!! alert_html( $message, 'success' ) !!}
 @endif
 @if ($message = Session::get('danger'))
    {!! alert_html( $message, 'danger' ) !!} 
 @endif
 @if ($message = Session::get('warning'))
    {!! alert_html( $message, 'warning' ) !!} 
 @endif
 @if ($message = Session::get('info'))
   {!! alert_html( $message, 'info' ) !!} 
 @endif
 @if ($message = Session::get('light'))
   {!! alert_html( $message, 'light' ) !!} 
 @endif
 @if ($message = Session::get('dark'))
   {!! alert_html( $message, 'dark' ) !!} 
 @endif

 