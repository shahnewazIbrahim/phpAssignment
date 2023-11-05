SELECT
    c.name AS customer_name,
    SUM(oi.quantity * oi.unit_price) AS total_purchase_amount
FROM
    customers c
LEFT JOIN orders o ON c.id = o.customer_id
LEFT JOIN Order_Items oi ON o.id = oi.order_id
GROUP BY
    c.id, c.name
ORDER BY
    total_purchase_amount DESC
LIMIT 5;