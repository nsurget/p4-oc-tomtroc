<?php

/**
 * Defines all application route names as constants.
 * This prevents typos and allows for easy refactoring.
 */
final class AppRoutes
{
    // --- General Pages ---
    public const HOME = 'home';

    // --- User Authentication ---
    public const REGISTER_FORM = 'registerForm';
    public const LOGIN_FORM     = 'loginForm';

    public const LOGIN_PROCESS  = 'loginProcess';
    public const LOGOUT         = 'logout';

    // --- User ---
    public const USER_PROFILE = 'userProfile';
    public const USER_EDIT = 'userEdit';
    public const USER_PUBLIC_PROFILE = 'userPublicProfile';

    // --- Books ---
    public const SHOW_BOOKS = 'showBooks';

    public const SHOW_SINGLE_BOOK = 'showSingleBook';

    public const ADD_BOOK_FORM = 'addBookForm';

    public const EDIT_BOOK_FORM = 'editBookForm';

    public const SAVE_BOOK = 'saveBook';

    public const DELETE_BOOK = 'deleteBook';

    // --- Chat ---
    public const SHOW_CHAT = 'showChat';

    public const ADD_MESSAGE = 'addMessage';
}