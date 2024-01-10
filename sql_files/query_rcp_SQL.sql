select *
from rcp_info
where rcp_id not in (
    select distinct rcp_id
    from rcp_ingr
    where ingr_id in (
        select ingr_id
        from user_ingr
        where user_id = 0 and amount = 0
    )
)