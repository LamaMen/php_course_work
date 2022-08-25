<x-layout pageIndex="1" title="Достопримечательности">
    <div class="container">
        <div class="px-4 pt-5 my-5 text-start border-bottom">
            <h1 class="display-4 fw-bold">Достопримечательности</h1>
            <div class="col-lg-8">
                <p class="lead mb-2">
                    Вели́кие Лу́ки — город в Псковской области России. «Город воинской славы».
                    Крупный многопрофильный торгово-промышленный и культурно-образовательный центр
                    юга Псковской области. Является городом областного подчинения, в котором находится
                    административный центр Великолукского района, причём сами Великие Луки образуют самостоятельное
                    муниципальное образование город Великие Луки в статусе городского округа.
                </p>
                <p class="lead mb-4"><b>Прогуляйтесь по нашим достопримечательностям!</b></p>
            </div>
        </div>

        <div>
            @include('showplaces.list', ['showplaces' => $model->items])
        </div>

        <div class="album px-5">
            <x-shared.pages-nav actual="{{ $model->actual }}" count="{{ $model->count }}"></x-shared.pages-nav>
        </div>
    </div>
</x-layout>
