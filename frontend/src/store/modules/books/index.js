import BaseService from "@/services/BaseService";
import router from '@/router';
import { notify } from "@kyvg/vue3-notification";

const state = {
    books: [],
    book: [],
    errors: [],
};

const mutations = {
    SET_BOOKS: (state, books) => state.books = books,
    STORE_BOOK: (state, book) => state.book.unshift(book),
    SET_ERRORS: (state, err) => state.errors = err,
    SET_BOOK: (state, book) => state.book = book,
    UPDATE_BOOK: (state, book) => {
        const index = state.books.findIndex(findBook => findBook.id === book.id);

        if (index !== -1) {
            state.books.splice(index, 1, book);
        }
    },
    DELETE_BOOK: (state, delete_book_id) => state.books.data = state.books.data.filter(book => book.id !== delete_book_id)
};

const actions = {
    getBooks({ commit },search) {
        commit("SET_ERRORS", {});
        BaseService.getBooks(search)
            .then((response) => {
                commit("SET_BOOKS", response.data.data);
            }).catch((err) => {
                if (err.response.status == 422) {
                    commit('SET_ERRORS', err.response.data.errors);
                }
            });
    },
    storeBook({ commit }, book) {
        commit("SET_ERRORS", {});
        BaseService.storeBook(book)
            .then((response) => {
                commit("STORE_BOOK", response.data);
                const searchBookObj = {
                    search: "",
                    pageIndex: 1,
                };
                router.push({ name: "Books" , searchBookObj}); 
                notify({
                    title: response.data.message,
                });
            }).catch((err) => {
                if (err.response.status === 422) {
                    commit("SET_ERRORS", err.response.data.errors)
                }
            });
    },
    findBook({ commit }, id) {
        commit("SET_ERRORS", {});

        BaseService.getBook(id)
            .then((response) => {
                commit("SET_BOOK", response.data.data);
            }).catch((err) => {
                if (err.response.status == 422) {
                    commit('SET_ERRORS', err.response.data.errors);
                }
            });
    },
    updateBook({ commit }, book) {
        commit('SET_ERRORS', {});
            BaseService.updateBook(book)
            .then((response) => {
                commit("UPDATE_BOOK", response.data);
                const searchBookObj = {
                    search: "",
                    pageIndex: 1,
                };
                router.push({ name: "Books" , searchBookObj}); 
                notify({
                    title: response.data.message,
                });
            }).catch((err) => {
                if (err.response.status == 422) {
                    commit('SET_ERRORS', err.response.data.errors);
                }
            });
    },
    deleteBook({ commit }, id) {
        BaseService.deleteBook(id)
            .then((response) => {
                commit("DELETE_BOOK", id)
                
            }).catch((err) => {
                console.log(err);
            });
    }
};

const getters = {
    getAllBooks: (state) => state.books,
    getSingleBook: (state) => state.book,
    getError: (state) => state.errors,
};

export default {
    state,
    mutations,
    actions,
    getters
}
