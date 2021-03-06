<?php

namespace RebelCode\Iris;

use RebelCode\Iris\Fetching\ItemProvider;

/**
 * Contain results generated by an operator that works with lists of {@link Item} instances.
 *
 * Results can be either successful, erroneous or a mix of both. When the {@link Result::$success} flag is set to true,
 * consumers can assume that the operator was successful in retrieving items, either entirely or in part. To assert
 * to what extent the retrieval was successful, consumers should check the {@link Result::$errors} list. If the list is
 * empty, then retrieval was entirely successful. Otherwise, some problems arose during the retrieval process that did
 * not warrant a total failure. Operators are left to their own discretion on how to decide what is considered a total
 * failure and what isn't.
 *
 * On the contrary, when the {@link Result::$success} flag is set to false, consumers can assume that the operation has
 * failed entirely and no meaningful result could be obtained. In this scenario, consumers can also assume that there
 * will be at least one error in the {@link Result::$errors} list.
 *
 * Retrieved items can be read from the {@link Result::$items} array. This array should be assumed to be numeric.
 *
 * It is possible for an operator to indicate success while also not providing any items in the result. Consumers are
 * advised to first check whether the {@link Result::$success} flag is false to handle a complete failure. In the
 * event of a true value, consumers may proceed assuming success. However, the {@link Result::$errors} should be
 * handled
 * in some way, whether by the direct or a delegated consumer.
 *
 * Additional data can be attached to the result using the {@link Result::$data} associative array. Any data stored in
 * this property is non-standard and should only be depended on when explicitly dealing with specific operator
 * implementations. For instance, HTTP headers may be stored when working with an HTTP {@link ItemProvider}.
 *
 * Finally, results may optionally provide a means by which more results can be obtained. This is done through the
 * {@link Result::$next} callback. If not null, this property should be a callback which, when called returns a new
 * {@link Result} instance. This callback should NOT depend on any arguments. This callback is typically set by a
 * {@link ItemProvider} instance to allow consumers to easily retrieve the next batch of items, in cases where the
 * provider was given a limit or the results need to be paginated.
 *
 * @since [*next-version*]
 */
class Result
{
    /**
     * Whether or not item retrieval was successful.
     *
     * @since [*next-version*]
     *
     * @var bool
     */
    public $success = true;

    /**
     * The error if item retrieval failed, or null if successful.
     *
     * @since [*next-version*]
     *
     * @var Error[]
     */
    public $errors = [];

    /**
     * The retrieved items.
     *
     * @since [*next-version*]
     *
     * @var Item[]
     */
    public $items = [];

    /**
     * Any addition data attached to the result.
     *
     * @since [*next-version*]
     *
     * @var array
     */
    public $data = [];

    /**
     * A callback to get the next batch of items, or null if no more items to retrieve.
     *
     * @since [*next-version*]
     *
     * @var callable|null
     */
    public $next = null;

    /**
     * Checks whether the result has errors.
     *
     * @since [*next-version*]
     *
     * @return bool True if the result has errors, false if not.
     */
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    /**
     * Helper method to safely invoke the result's {@link Result::$next} callback, if one is set.
     *
     * @since [*next-version*]
     *
     * @return Result The result. An empty result will be returned if the {@link Result::$next} callback is null.
     */
    public function getNextResult() : ?Result
    {
        return $this->next !== null ? ($this->next)() : new Result();
    }

    /**
     * Retrieves the next result, if one is available, and merges this instance with the new result.
     *
     * @since [*next-version*]
     *
     * @return static The merged result, or the same instance if no {@link Result::$next} callback is set.
     */
    public function withNextResult()
    {
        if ($this->next === null) {
            return $this;
        } else {
            $result = $this->getNextResult();

            if (!$result->hasErrors()) {
                $result->items = array_merge($this->items, $result->items);
            }

            return $result;
        }
    }

    /**
     * Merges this result with another.
     *
     * @since [*next-version*]
     *
     * @param Result $other     The result to merge with.
     * @param bool   $mergeNext Whether to merge the {@link Result::$next} callback or not.
     *
     * @return Result The merged result.
     */
    public function merge(Result $other, bool $mergeNext = true)
    {
        $new = new Result();
        $new->success = $this->success || $other->success;
        $new->items = array_merge($this->items, $other->items);
        $new->data = array_merge($this->data, $other->data);
        $new->errors = array_merge($this->errors, $other->errors);

        if ($mergeNext) {
            $new->next = function () use ($other) {
                $r1 = $this->getNextResult();
                $r2 = $other->getNextResult();

                return $r1->merge($r2);
            };
        }

        return $new;
    }

    /**
     * Creates a successful result.
     *
     * @since [*next-version*]
     *
     * @param array         $items The items.
     * @param array         $data  Optional data to store in the result.
     * @param callable|null $next  Optional callback to get the next batch of items.
     *
     * @return self The created result.
     */
    public static function success(array $items, array $data = [], callable $next = null) : self
    {
        $result = new static();

        $result->success = true;
        $result->errors = [];
        $result->items = $items;
        $result->data = $data;
        $result->next = $next;

        return $result;
    }

    /**
     * Creates an erroneous result.
     *
     * @since [*next-version*]
     *
     * @param string $message The error message.
     * @param string $code    The error code.
     *
     * @return Result The created result.
     */
    public static function error(string $message, string $code = '') : self
    {
        $result = new static();

        $result->success = false;
        $result->errors = [new Error($message, $code)];

        return $result;
    }

    /**
     * Creates an empty result.
     *
     * @since [*next-version*]
     *
     * @return static The created result.
     */
    public static function empty()
    {
        return new static();
    }
}
