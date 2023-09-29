<?php

namespace Http\Session;

class SessionManager
{
    /**
     * Create SESSION
     *
     * @param string|null $cacheExpire
     * @param string|null $cacheLimiter
     */
    public function __construct(string $cacheExpire = null, string $cacheLimiter = null)
    {
        if (session_status() === PHP_SESSION_NONE) {

            if ($cacheLimiter !== null) {
                session_cache_limiter($cacheLimiter);
            }

            if ($cacheExpire !== null) {
                session_cache_expire($cacheExpire);
            }

            session_start();
        }
    }

    /**
     * Get SESSION variable
     * 
     * @param string $key   Variable name
     * @return mixed
     */
    public function get(string $key)
    {
        if ($this->has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * Set SESSION variable
     * 
     * @param string $key   Variable name
     * @param mixed $value  Variable value
     */
    public function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    /**
     * Remove variable from SESSION
     *
     * @param string $key   Variable name
     * @return void
     */
    public function remove(string $key): void
    {
        if ($this->has($key)) {
            unset($_SESSION[$key]);
        }
    }

    /**
     * Unset SESSION
     *
     * @return void
     */
    public function clear(): void
    {
        session_unset();
    }

    /**
     * Check if SESSION has variable 
     *
     * @param string $key   Variable name
     * @return boolean
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }
}
