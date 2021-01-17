<div class="js-cookie-consent cookie-consent font-medium p-4 text-center fixed bottom-0 w-full bg-header-bg dark:bg-gray-900 text-white">

    <span class="cookie-consent__message">
        {!! trans('cookieConsent::texts.message') !!}. <a href="{{ route('cookies') }}" class="underline focus:outline-none hover:text-dark-link focus:text-dark-link">Más información</a>
    </span>

    <button class="js-cookie-consent-agree cookie-consent__agree block mx-auto mt-3 font-bold rounded px-6 py-1.5 bg-pretty-red text-white focus:outline-none hover:bg-red-500 focus:bg-red-500">
        {{ trans('cookieConsent::texts.agree') }}
    </button>

</div>
