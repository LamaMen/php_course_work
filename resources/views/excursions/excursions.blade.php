<x-layout pageIndex="2" title="Экскурсии">
    <div class="container">
        <div class="px-4 pt-5 my-5 text-start border-bottom">
            <h1 class="display-4 fw-bold">Популярные экскурсии</h1>
            <div class="col-lg-8">
                <p class="lead mb-2">
                    Великие Луки – «ключ древних южных владений Новгородской Державы», так писал о городе
                    великий российский историк Карамзин. И это действительно так, потому что город Великие
                    Луки был настоящим городом-стражем северо-западных границ нашей Отчизны. История Великих
                    Лук насчитывает более восьми веков.</p>
                <p class="lead mb-4"><b>Узнайте про этот город лучше в одной из нащих экскурсий!</b></p>
            </div>
        </div>

        <div>
            @include('excursions.list', ['excursions' => $model->items])
        </div>

        <div class="album px-5">
            <x-shared.pages-nav actual="{{ $model->actual }}" count="{{ $model->count }}"></x-shared.pages-nav>
        </div>
    </div>
</x-layout>
