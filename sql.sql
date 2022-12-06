SELECT
    goods.id,
    goods.name
FROM
    goods
WHERE
    goods.id IN (
        SELECT
            goods_tags.goods_id
        FROM
            goods_tags
        GROUP BY
            goods_tags.goods_id
        HAVING
            COUNT(goods_tags.goods_id) = (
                SELECT
                    COUNT(tags.id)
                FROM
                    tags
            )
    );

SELECT
    department_id
FROM
    evaluations
WHERE
    gender = true
GROUP BY
    department_id
HAVING
    MIN(value) > 5;