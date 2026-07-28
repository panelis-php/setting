<x-mail::message>
  @lang('setting::mail.test_content')

  <x-mail::button :url="$url">
    @lang('setting::mail.btn.go_to_site')
  </x-mail::button>
</x-mail::message>
