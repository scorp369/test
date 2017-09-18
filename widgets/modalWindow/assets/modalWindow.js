/**
 * js модального окна для редактирования пользователя
 */
(function () {
    var self = {};

    /** jquery элементы с которыми работает данный виджет  */
    self.jqe = {
        /** wrapper модального окна */
        modalWindowWrapper: $('.js-modal-window-wrapper'),

        /** элемент переключающий модальное окно при событии onclick */
        toggleModalWindow: $('.js-toggle-modal-window'),
    };

    /** инициализировать данный виджет */
    self.init = function () {
        // переключить видимость модального окна при нажатии на переключатель
        self.jqe.toggleModalWindow.on('click', function () {
            self.jqe.modalWindowWrapper.toggle();


        });

        // переключить видимость модального окна при нажатии на его wrapper
        self.jqe.modalWindowWrapper.on('click', function () {
            $(this).toggle();
        });

        // отменить всплытие событий при нажатии на модальное окно
        self.jqe.modalWindowWrapper.children().on('click', function (e) {
            e.stopPropagation();
        });
    };

    self.init();
}());