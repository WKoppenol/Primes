<?php
/**
 * Finds a list of prime numbers below an integer value.
 * @param int $value The value you want to get all prime numbers for (excluding).
 * @remarks Higher values of $value will cause this function to perform much slower.
 * @return Array containing a sorted (ascending) list of integers which are prime numbers.
 */
function find_primes_below($value) {
    // Input must be an integer
    assert(is_int($value));

    $result = array();

    // 2 is the only prime number which is even, we add a special case for it here
    // so we can optimize the potentially heavy loop that will find the rest.
    if ($value > 2) {
        $result[] = 2;
    }

    // 0 and 1 are no a prime numbers so we can exclude them. Even numbers cannot 
    // be prime numbers so we skip those (hence the special case for 2 above).
    for ($candidate = 3; $candidate < $value; $candidate += 2) {
        $is_prime = true;

        // The highest valid divisor cannot be higher than the sqrt of our candidate.
        // At that point all higher values will no longer yield a valid divisor.
        $highest_valid_divisor = (int) ceil(sqrt($candidate));

        // We don't need to check even numbers since it's not divisible by 2
        // at this point. No point in checking if our candidate is divisible
        // by any other even number.
        for ($j = 3; $j <= $highest_valid_divisor; $j += 2) {
            if ($candidate % $j === 0) {
                $is_prime = false;
                break;
            }
        }

        if ($is_prime) {
            $result[] = $candidate;
        }
    }

    return $result;
}
