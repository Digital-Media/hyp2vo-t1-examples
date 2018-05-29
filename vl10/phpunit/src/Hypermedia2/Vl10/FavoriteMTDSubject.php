<?php
namespace Hypermedia2\Vl10;

use Exception;

class FavoriteMTDSubject
{
    /**
     * The user's favorite MTD subject.
     *
     * @var string
     */
    private $favoriteSubject;

    /**
     * FavoriteMTDSubject constructor.
     *
     * @param string $favoriteSubject The favorite subject to store.
     */
    public function __construct(string $favoriteSubject)
    {
        $this->favoriteSubject = $favoriteSubject;
    }

    /**
     * Returns the favorite MTD subject.
     *
     * @return string The best subject in MTD.
     */
    public function say(): string
    {
        return "The best subject in MTD is " . $this->favoriteSubject . "!";
    }

    /**
     * Responds to a favorite subject statement.
     * @param string $input The other statement.
     *
     * @return string The reply to the statement.
     * @throws Exception Thrown if not agreeing.
     */
    public function respondTo(string $input): string
    {
        $input = strtolower($input);
        $myFavoriteSubject = strtolower($this->favoriteSubject);

        if (mb_strpos($input, $myFavoriteSubject) === false) {
            throw new Exception(sprintf("Never! %s is the best subject in MTD!", $this->favoriteSubject));
        }

        return "Absolutely true!";
    }
}
