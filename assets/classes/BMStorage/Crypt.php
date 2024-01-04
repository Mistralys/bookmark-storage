<?php
/**
 * @package BMStorage
 * @subpackage Crypt
 */

declare(strict_types=1);

namespace BMStorage;

/**
 * Encrypts and decrypts strings. Used to store data in
 * the database, in obfuscated form.
 *
 * NOTE: Thanks to a marker in encoded string, they are
 * not encoded twice. Both {@link self::encode()} and
 * {@link self::decode()} can be called on the same string
 * repeatedly.
 *
 * @package BMStorage
 * @subpackage Crypt
 */
class Crypt
{
    private const ENCODING_MARKER = '$ENC%';

    public static function encode(string $subject) : string
    {
        if(!str_starts_with($subject, self::ENCODING_MARKER)) {
            return self::ENCODING_MARKER .convert_uuencode($subject);
        }

        return $subject;
    }

    public static function decode(string $subject) : string
    {
        if(str_starts_with($subject, self::ENCODING_MARKER)) {
            return convert_uudecode(substr($subject, strlen(self::ENCODING_MARKER)));
        }

        return $subject;
    }
}
