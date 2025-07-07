<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Determine whether the user can view any posts.
     */
    public function viewAny(User $user): bool
    {
        return true; // allow viewing all posts
    }

    /**
     * Determine whether the user can view a single post.
     */
    public function view(User $user, Post $post): bool
    {
        return true; // allow all users to view any post
    }

    /**
     * Determine whether the user can create a post.
     */
    public function create(User $user): bool
    {
        return true; // any logged-in user can create
    }

    /**
     * Determine whether the user can update the post.
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can delete the post.
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Restore — unused for now
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Force delete — unused for now
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}
