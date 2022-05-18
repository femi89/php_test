<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'articles' => [
        'name' => 'Articles',
        'index_title' => 'Articles List',
        'new_title' => 'New Article',
        'create_title' => 'Create Article',
        'edit_title' => 'Edit Article',
        'show_title' => 'Show Article',
        'inputs' => [
            'subject' => 'Subject',
            'slug' => 'Slug',
            'body' => 'Body',
        ],
    ],

    'article_likes' => [
        'name' => 'Article Likes',
        'index_title' => 'ArticleLikes List',
        'new_title' => 'New Article like',
        'create_title' => 'Create ArticleLike',
        'edit_title' => 'Edit ArticleLike',
        'show_title' => 'Show ArticleLike',
        'inputs' => [
            'like' => 'Like',
            'dis_like' => 'Dis Like',
            'article_id' => 'Article',
            'user_id' => 'User',
        ],
    ],

    'comments' => [
        'name' => 'Comments',
        'index_title' => 'Comments List',
        'new_title' => 'New Comment',
        'create_title' => 'Create Comment',
        'edit_title' => 'Edit Comment',
        'show_title' => 'Show Comment',
        'inputs' => [
            'article_id' => 'Article',
            'user_id' => 'User',
            'message' => 'Message',
            'isGuest' => 'Is Guest',
            'guest_name' => 'Guest Name',
        ],
    ],

    'tags' => [
        'name' => 'Tags',
        'index_title' => 'Tags List',
        'new_title' => 'New Tag',
        'create_title' => 'Create Tag',
        'edit_title' => 'Edit Tag',
        'show_title' => 'Show Tag',
        'inputs' => [
            'name' => 'Name',
            'slug' => 'Slug',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],
];
