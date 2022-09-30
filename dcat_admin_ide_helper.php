<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection alias
     * @property Grid\Column|Collection authors
     * @property Grid\Column|Collection enable
     * @property Grid\Column|Collection imported
     * @property Grid\Column|Collection config
     * @property Grid\Column|Collection require
     * @property Grid\Column|Collection require_dev
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection day
     * @property Grid\Column|Collection day_type
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection year
     * @property Grid\Column|Collection accountant_date_id
     * @property Grid\Column|Collection end_at
     * @property Grid\Column|Collection month
     * @property Grid\Column|Collection start_at
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection input
     * @property Grid\Column|Collection ip
     * @property Grid\Column|Collection method
     * @property Grid\Column|Collection path
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection company_id
     * @property Grid\Column|Collection deleted_at
     * @property Grid\Column|Collection department_id
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection tel
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection allocation_id
     * @property Grid\Column|Collection num
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection product_id
     * @property Grid\Column|Collection sku_id
     * @property Grid\Column|Collection sum_price
     * @property Grid\Column|Collection charge_man
     * @property Grid\Column|Collection in_store_id
     * @property Grid\Column|Collection mark
     * @property Grid\Column|Collection out_store_id
     * @property Grid\Column|Collection review_status
     * @property Grid\Column|Collection sn
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection total_money
     * @property Grid\Column|Collection trans_at
     * @property Grid\Column|Collection actual_num
     * @property Grid\Column|Collection item_id
     * @property Grid\Column|Collection percent
     * @property Grid\Column|Collection standard
     * @property Grid\Column|Collection stock_batch_id
     * @property Grid\Column|Collection cost_price
     * @property Grid\Column|Collection order_id
     * @property Grid\Column|Collection should_num
     * @property Grid\Column|Collection apply_id
     * @property Grid\Column|Collection order_no
     * @property Grid\Column|Collection other
     * @property Grid\Column|Collection with_id
     * @property Grid\Column|Collection approval_type_id
     * @property Grid\Column|Collection check_users
     * @property Grid\Column|Collection desc
     * @property Grid\Column|Collection attr_id
     * @property Grid\Column|Collection caozuo
     * @property Grid\Column|Collection check_at
     * @property Grid\Column|Collection contract_money
     * @property Grid\Column|Collection fee_type_id
     * @property Grid\Column|Collection pay_at
     * @property Grid\Column|Collection pay_method
     * @property Grid\Column|Collection purchase_order_id
     * @property Grid\Column|Collection this_time_money
     * @property Grid\Column|Collection unpay_money
     * @property Grid\Column|Collection zhanyong
     * @property Grid\Column|Collection blackhead
     * @property Grid\Column|Collection bulkiness
     * @property Grid\Column|Collection carbon_fiber
     * @property Grid\Column|Collection cleanliness
     * @property Grid\Column|Collection duck_ratio
     * @property Grid\Column|Collection feather_silk
     * @property Grid\Column|Collection flower_number
     * @property Grid\Column|Collection fluffy_silk
     * @property Grid\Column|Collection heterochromatic_hair
     * @property Grid\Column|Collection magazine
     * @property Grid\Column|Collection moisture
     * @property Grid\Column|Collection odor
     * @property Grid\Column|Collection prev_sku_stock_batch_id
     * @property Grid\Column|Collection raw_footage
     * @property Grid\Column|Collection sku_stock_batch_id
     * @property Grid\Column|Collection terrestrial_feather
     * @property Grid\Column|Collection velvet
     * @property Grid\Column|Collection bank
     * @property Grid\Column|Collection bank_count
     * @property Grid\Column|Collection hostname
     * @property Grid\Column|Collection short_title
     * @property Grid\Column|Collection tax_number
     * @property Grid\Column|Collection actual_amount
     * @property Grid\Column|Collection cost_type
     * @property Grid\Column|Collection pay_type
     * @property Grid\Column|Collection should_amount
     * @property Grid\Column|Collection with_order_no
     * @property Grid\Column|Collection accountant_item_id
     * @property Grid\Column|Collection category
     * @property Grid\Column|Collection company_name
     * @property Grid\Column|Collection discount_amount
     * @property Grid\Column|Collection settlement_amount
     * @property Grid\Column|Collection settlement_completed
     * @property Grid\Column|Collection total_amount
     * @property Grid\Column|Collection address
     * @property Grid\Column|Collection bank_account
     * @property Grid\Column|Collection bank_name
     * @property Grid\Column|Collection bank_title
     * @property Grid\Column|Collection bank_top
     * @property Grid\Column|Collection contact_department
     * @property Grid\Column|Collection contact_email
     * @property Grid\Column|Collection contact_qq
     * @property Grid\Column|Collection contact_tel
     * @property Grid\Column|Collection department
     * @property Grid\Column|Collection link
     * @property Grid\Column|Collection money_limit
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection sign_start_at
     * @property Grid\Column|Collection sign_stop_at
     * @property Grid\Column|Collection signatory
     * @property Grid\Column|Collection tax_code
     * @property Grid\Column|Collection customer_id
     * @property Grid\Column|Collection drawee_id
     * @property Grid\Column|Collection arrived_at
     * @property Grid\Column|Collection company
     * @property Grid\Column|Collection enclosure
     * @property Grid\Column|Collection money
     * @property Grid\Column|Collection order_type
     * @property Grid\Column|Collection send_at
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection reply
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection has_caozuo
     * @property Grid\Column|Collection has_zhanyong
     * @property Grid\Column|Collection caozuo_rate
     * @property Grid\Column|Collection money_ccf
     * @property Grid\Column|Collection money_czf
     * @property Grid\Column|Collection money_jkgs
     * @property Grid\Column|Collection money_other
     * @property Grid\Column|Collection money_sc
     * @property Grid\Column|Collection money_wlf
     * @property Grid\Column|Collection money_yhsxf
     * @property Grid\Column|Collection money_zy
     * @property Grid\Column|Collection money_zzs
     * @property Grid\Column|Collection pics
     * @property Grid\Column|Collection products
     * @property Grid\Column|Collection year_rate
     * @property Grid\Column|Collection zhanyong_rate
     * @property Grid\Column|Collection batch_no
     * @property Grid\Column|Collection position_id
     * @property Grid\Column|Collection diff_num
     * @property Grid\Column|Collection sum_cost_price
     * @property Grid\Column|Collection happen_date
     * @property Grid\Column|Collection prefix
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection bar_code
     * @property Grid\Column|Collection category_id
     * @property Grid\Column|Collection item_no
     * @property Grid\Column|Collection product_category_id
     * @property Grid\Column|Collection product_date
     * @property Grid\Column|Collection py_code
     * @property Grid\Column|Collection quality_time
     * @property Grid\Column|Collection stock_max
     * @property Grid\Column|Collection stock_min
     * @property Grid\Column|Collection unit_id
     * @property Grid\Column|Collection attr_value_ids
     * @property Grid\Column|Collection back_num
     * @property Grid\Column|Collection purchase_order_back_id
     * @property Grid\Column|Collection check_order_id
     * @property Grid\Column|Collection apply_at
     * @property Grid\Column|Collection finished_at
     * @property Grid\Column|Collection supplier_id
     * @property Grid\Column|Collection advance_charge_money
     * @property Grid\Column|Collection check_status
     * @property Grid\Column|Collection frame_contract_id
     * @property Grid\Column|Collection sign_at
     * @property Grid\Column|Collection sign_man
     * @property Grid\Column|Collection accountant_id
     * @property Grid\Column|Collection settlement_at
     * @property Grid\Column|Collection back_at
     * @property Grid\Column|Collection back_money
     * @property Grid\Column|Collection store_id
     * @property Grid\Column|Collection return_num
     * @property Grid\Column|Collection address_id
     * @property Grid\Column|Collection params
     * @property Grid\Column|Collection total_money_cn
     * @property Grid\Column|Collection profit
     * @property Grid\Column|Collection sale_order_id
     * @property Grid\Column|Collection already_actual_amount
     * @property Grid\Column|Collection already_discount_amount
     * @property Grid\Column|Collection order_amount
     * @property Grid\Column|Collection statement_order_id
     * @property Grid\Column|Collection balance_num
     * @property Grid\Column|Collection flag
     * @property Grid\Column|Collection in_num
     * @property Grid\Column|Collection in_position_id
     * @property Grid\Column|Collection in_price
     * @property Grid\Column|Collection init_num
     * @property Grid\Column|Collection inventory_diff_num
     * @property Grid\Column|Collection inventory_num
     * @property Grid\Column|Collection out_num
     * @property Grid\Column|Collection out_position_id
     * @property Grid\Column|Collection out_price
     * @property Grid\Column|Collection store_in_id
     * @property Grid\Column|Collection car_number
     * @property Grid\Column|Collection delivery_id
     * @property Grid\Column|Collection in_at
     * @property Grid\Column|Collection store_out_id
     * @property Grid\Column|Collection out_at
     * @property Grid\Column|Collection man
     * @property Grid\Column|Collection move_price
     * @property Grid\Column|Collection position
     * @property Grid\Column|Collection save_price
     * @property Grid\Column|Collection store_company_id
     * @property Grid\Column|Collection craft_id
     * @property Grid\Column|Collection finish_num
     * @property Grid\Column|Collection operator
     * @property Grid\Column|Collection plan_num
     * @property Grid\Column|Collection batch_id
     * @property Grid\Column|Collection family_hash
     * @property Grid\Column|Collection sequence
     * @property Grid\Column|Collection should_display_on_index
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection entry_uuid
     * @property Grid\Column|Collection tag
     * @property Grid\Column|Collection email_verified_at
     *
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection alias(string $label = null)
     * @method Grid\Column|Collection authors(string $label = null)
     * @method Grid\Column|Collection enable(string $label = null)
     * @method Grid\Column|Collection imported(string $label = null)
     * @method Grid\Column|Collection config(string $label = null)
     * @method Grid\Column|Collection require(string $label = null)
     * @method Grid\Column|Collection require_dev(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection day(string $label = null)
     * @method Grid\Column|Collection day_type(string $label = null)
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection year(string $label = null)
     * @method Grid\Column|Collection accountant_date_id(string $label = null)
     * @method Grid\Column|Collection end_at(string $label = null)
     * @method Grid\Column|Collection month(string $label = null)
     * @method Grid\Column|Collection start_at(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection input(string $label = null)
     * @method Grid\Column|Collection ip(string $label = null)
     * @method Grid\Column|Collection method(string $label = null)
     * @method Grid\Column|Collection path(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection company_id(string $label = null)
     * @method Grid\Column|Collection deleted_at(string $label = null)
     * @method Grid\Column|Collection department_id(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection tel(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection allocation_id(string $label = null)
     * @method Grid\Column|Collection num(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection product_id(string $label = null)
     * @method Grid\Column|Collection sku_id(string $label = null)
     * @method Grid\Column|Collection sum_price(string $label = null)
     * @method Grid\Column|Collection charge_man(string $label = null)
     * @method Grid\Column|Collection in_store_id(string $label = null)
     * @method Grid\Column|Collection mark(string $label = null)
     * @method Grid\Column|Collection out_store_id(string $label = null)
     * @method Grid\Column|Collection review_status(string $label = null)
     * @method Grid\Column|Collection sn(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection total_money(string $label = null)
     * @method Grid\Column|Collection trans_at(string $label = null)
     * @method Grid\Column|Collection actual_num(string $label = null)
     * @method Grid\Column|Collection item_id(string $label = null)
     * @method Grid\Column|Collection percent(string $label = null)
     * @method Grid\Column|Collection standard(string $label = null)
     * @method Grid\Column|Collection stock_batch_id(string $label = null)
     * @method Grid\Column|Collection cost_price(string $label = null)
     * @method Grid\Column|Collection order_id(string $label = null)
     * @method Grid\Column|Collection should_num(string $label = null)
     * @method Grid\Column|Collection apply_id(string $label = null)
     * @method Grid\Column|Collection order_no(string $label = null)
     * @method Grid\Column|Collection other(string $label = null)
     * @method Grid\Column|Collection with_id(string $label = null)
     * @method Grid\Column|Collection approval_type_id(string $label = null)
     * @method Grid\Column|Collection check_users(string $label = null)
     * @method Grid\Column|Collection desc(string $label = null)
     * @method Grid\Column|Collection attr_id(string $label = null)
     * @method Grid\Column|Collection caozuo(string $label = null)
     * @method Grid\Column|Collection check_at(string $label = null)
     * @method Grid\Column|Collection contract_money(string $label = null)
     * @method Grid\Column|Collection fee_type_id(string $label = null)
     * @method Grid\Column|Collection pay_at(string $label = null)
     * @method Grid\Column|Collection pay_method(string $label = null)
     * @method Grid\Column|Collection purchase_order_id(string $label = null)
     * @method Grid\Column|Collection this_time_money(string $label = null)
     * @method Grid\Column|Collection unpay_money(string $label = null)
     * @method Grid\Column|Collection zhanyong(string $label = null)
     * @method Grid\Column|Collection blackhead(string $label = null)
     * @method Grid\Column|Collection bulkiness(string $label = null)
     * @method Grid\Column|Collection carbon_fiber(string $label = null)
     * @method Grid\Column|Collection cleanliness(string $label = null)
     * @method Grid\Column|Collection duck_ratio(string $label = null)
     * @method Grid\Column|Collection feather_silk(string $label = null)
     * @method Grid\Column|Collection flower_number(string $label = null)
     * @method Grid\Column|Collection fluffy_silk(string $label = null)
     * @method Grid\Column|Collection heterochromatic_hair(string $label = null)
     * @method Grid\Column|Collection magazine(string $label = null)
     * @method Grid\Column|Collection moisture(string $label = null)
     * @method Grid\Column|Collection odor(string $label = null)
     * @method Grid\Column|Collection prev_sku_stock_batch_id(string $label = null)
     * @method Grid\Column|Collection raw_footage(string $label = null)
     * @method Grid\Column|Collection sku_stock_batch_id(string $label = null)
     * @method Grid\Column|Collection terrestrial_feather(string $label = null)
     * @method Grid\Column|Collection velvet(string $label = null)
     * @method Grid\Column|Collection bank(string $label = null)
     * @method Grid\Column|Collection bank_count(string $label = null)
     * @method Grid\Column|Collection hostname(string $label = null)
     * @method Grid\Column|Collection short_title(string $label = null)
     * @method Grid\Column|Collection tax_number(string $label = null)
     * @method Grid\Column|Collection actual_amount(string $label = null)
     * @method Grid\Column|Collection cost_type(string $label = null)
     * @method Grid\Column|Collection pay_type(string $label = null)
     * @method Grid\Column|Collection should_amount(string $label = null)
     * @method Grid\Column|Collection with_order_no(string $label = null)
     * @method Grid\Column|Collection accountant_item_id(string $label = null)
     * @method Grid\Column|Collection category(string $label = null)
     * @method Grid\Column|Collection company_name(string $label = null)
     * @method Grid\Column|Collection discount_amount(string $label = null)
     * @method Grid\Column|Collection settlement_amount(string $label = null)
     * @method Grid\Column|Collection settlement_completed(string $label = null)
     * @method Grid\Column|Collection total_amount(string $label = null)
     * @method Grid\Column|Collection address(string $label = null)
     * @method Grid\Column|Collection bank_account(string $label = null)
     * @method Grid\Column|Collection bank_name(string $label = null)
     * @method Grid\Column|Collection bank_title(string $label = null)
     * @method Grid\Column|Collection bank_top(string $label = null)
     * @method Grid\Column|Collection contact_department(string $label = null)
     * @method Grid\Column|Collection contact_email(string $label = null)
     * @method Grid\Column|Collection contact_qq(string $label = null)
     * @method Grid\Column|Collection contact_tel(string $label = null)
     * @method Grid\Column|Collection department(string $label = null)
     * @method Grid\Column|Collection link(string $label = null)
     * @method Grid\Column|Collection money_limit(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection sign_start_at(string $label = null)
     * @method Grid\Column|Collection sign_stop_at(string $label = null)
     * @method Grid\Column|Collection signatory(string $label = null)
     * @method Grid\Column|Collection tax_code(string $label = null)
     * @method Grid\Column|Collection customer_id(string $label = null)
     * @method Grid\Column|Collection drawee_id(string $label = null)
     * @method Grid\Column|Collection arrived_at(string $label = null)
     * @method Grid\Column|Collection company(string $label = null)
     * @method Grid\Column|Collection enclosure(string $label = null)
     * @method Grid\Column|Collection money(string $label = null)
     * @method Grid\Column|Collection order_type(string $label = null)
     * @method Grid\Column|Collection send_at(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection reply(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection has_caozuo(string $label = null)
     * @method Grid\Column|Collection has_zhanyong(string $label = null)
     * @method Grid\Column|Collection caozuo_rate(string $label = null)
     * @method Grid\Column|Collection money_ccf(string $label = null)
     * @method Grid\Column|Collection money_czf(string $label = null)
     * @method Grid\Column|Collection money_jkgs(string $label = null)
     * @method Grid\Column|Collection money_other(string $label = null)
     * @method Grid\Column|Collection money_sc(string $label = null)
     * @method Grid\Column|Collection money_wlf(string $label = null)
     * @method Grid\Column|Collection money_yhsxf(string $label = null)
     * @method Grid\Column|Collection money_zy(string $label = null)
     * @method Grid\Column|Collection money_zzs(string $label = null)
     * @method Grid\Column|Collection pics(string $label = null)
     * @method Grid\Column|Collection products(string $label = null)
     * @method Grid\Column|Collection year_rate(string $label = null)
     * @method Grid\Column|Collection zhanyong_rate(string $label = null)
     * @method Grid\Column|Collection batch_no(string $label = null)
     * @method Grid\Column|Collection position_id(string $label = null)
     * @method Grid\Column|Collection diff_num(string $label = null)
     * @method Grid\Column|Collection sum_cost_price(string $label = null)
     * @method Grid\Column|Collection happen_date(string $label = null)
     * @method Grid\Column|Collection prefix(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection bar_code(string $label = null)
     * @method Grid\Column|Collection category_id(string $label = null)
     * @method Grid\Column|Collection item_no(string $label = null)
     * @method Grid\Column|Collection product_category_id(string $label = null)
     * @method Grid\Column|Collection product_date(string $label = null)
     * @method Grid\Column|Collection py_code(string $label = null)
     * @method Grid\Column|Collection quality_time(string $label = null)
     * @method Grid\Column|Collection stock_max(string $label = null)
     * @method Grid\Column|Collection stock_min(string $label = null)
     * @method Grid\Column|Collection unit_id(string $label = null)
     * @method Grid\Column|Collection attr_value_ids(string $label = null)
     * @method Grid\Column|Collection back_num(string $label = null)
     * @method Grid\Column|Collection purchase_order_back_id(string $label = null)
     * @method Grid\Column|Collection check_order_id(string $label = null)
     * @method Grid\Column|Collection apply_at(string $label = null)
     * @method Grid\Column|Collection finished_at(string $label = null)
     * @method Grid\Column|Collection supplier_id(string $label = null)
     * @method Grid\Column|Collection advance_charge_money(string $label = null)
     * @method Grid\Column|Collection check_status(string $label = null)
     * @method Grid\Column|Collection frame_contract_id(string $label = null)
     * @method Grid\Column|Collection sign_at(string $label = null)
     * @method Grid\Column|Collection sign_man(string $label = null)
     * @method Grid\Column|Collection accountant_id(string $label = null)
     * @method Grid\Column|Collection settlement_at(string $label = null)
     * @method Grid\Column|Collection back_at(string $label = null)
     * @method Grid\Column|Collection back_money(string $label = null)
     * @method Grid\Column|Collection store_id(string $label = null)
     * @method Grid\Column|Collection return_num(string $label = null)
     * @method Grid\Column|Collection address_id(string $label = null)
     * @method Grid\Column|Collection params(string $label = null)
     * @method Grid\Column|Collection total_money_cn(string $label = null)
     * @method Grid\Column|Collection profit(string $label = null)
     * @method Grid\Column|Collection sale_order_id(string $label = null)
     * @method Grid\Column|Collection already_actual_amount(string $label = null)
     * @method Grid\Column|Collection already_discount_amount(string $label = null)
     * @method Grid\Column|Collection order_amount(string $label = null)
     * @method Grid\Column|Collection statement_order_id(string $label = null)
     * @method Grid\Column|Collection balance_num(string $label = null)
     * @method Grid\Column|Collection flag(string $label = null)
     * @method Grid\Column|Collection in_num(string $label = null)
     * @method Grid\Column|Collection in_position_id(string $label = null)
     * @method Grid\Column|Collection in_price(string $label = null)
     * @method Grid\Column|Collection init_num(string $label = null)
     * @method Grid\Column|Collection inventory_diff_num(string $label = null)
     * @method Grid\Column|Collection inventory_num(string $label = null)
     * @method Grid\Column|Collection out_num(string $label = null)
     * @method Grid\Column|Collection out_position_id(string $label = null)
     * @method Grid\Column|Collection out_price(string $label = null)
     * @method Grid\Column|Collection store_in_id(string $label = null)
     * @method Grid\Column|Collection car_number(string $label = null)
     * @method Grid\Column|Collection delivery_id(string $label = null)
     * @method Grid\Column|Collection in_at(string $label = null)
     * @method Grid\Column|Collection store_out_id(string $label = null)
     * @method Grid\Column|Collection out_at(string $label = null)
     * @method Grid\Column|Collection man(string $label = null)
     * @method Grid\Column|Collection move_price(string $label = null)
     * @method Grid\Column|Collection position(string $label = null)
     * @method Grid\Column|Collection save_price(string $label = null)
     * @method Grid\Column|Collection store_company_id(string $label = null)
     * @method Grid\Column|Collection craft_id(string $label = null)
     * @method Grid\Column|Collection finish_num(string $label = null)
     * @method Grid\Column|Collection operator(string $label = null)
     * @method Grid\Column|Collection plan_num(string $label = null)
     * @method Grid\Column|Collection batch_id(string $label = null)
     * @method Grid\Column|Collection family_hash(string $label = null)
     * @method Grid\Column|Collection sequence(string $label = null)
     * @method Grid\Column|Collection should_display_on_index(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection entry_uuid(string $label = null)
     * @method Grid\Column|Collection tag(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection name
     * @property Show\Field|Collection version
     * @property Show\Field|Collection alias
     * @property Show\Field|Collection authors
     * @property Show\Field|Collection enable
     * @property Show\Field|Collection imported
     * @property Show\Field|Collection config
     * @property Show\Field|Collection require
     * @property Show\Field|Collection require_dev
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection day
     * @property Show\Field|Collection day_type
     * @property Show\Field|Collection id
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection year
     * @property Show\Field|Collection accountant_date_id
     * @property Show\Field|Collection end_at
     * @property Show\Field|Collection month
     * @property Show\Field|Collection start_at
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection order
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection input
     * @property Show\Field|Collection ip
     * @property Show\Field|Collection method
     * @property Show\Field|Collection path
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection company_id
     * @property Show\Field|Collection deleted_at
     * @property Show\Field|Collection department_id
     * @property Show\Field|Collection password
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection tel
     * @property Show\Field|Collection username
     * @property Show\Field|Collection allocation_id
     * @property Show\Field|Collection num
     * @property Show\Field|Collection price
     * @property Show\Field|Collection product_id
     * @property Show\Field|Collection sku_id
     * @property Show\Field|Collection sum_price
     * @property Show\Field|Collection charge_man
     * @property Show\Field|Collection in_store_id
     * @property Show\Field|Collection mark
     * @property Show\Field|Collection out_store_id
     * @property Show\Field|Collection review_status
     * @property Show\Field|Collection sn
     * @property Show\Field|Collection status
     * @property Show\Field|Collection total_money
     * @property Show\Field|Collection trans_at
     * @property Show\Field|Collection actual_num
     * @property Show\Field|Collection item_id
     * @property Show\Field|Collection percent
     * @property Show\Field|Collection standard
     * @property Show\Field|Collection stock_batch_id
     * @property Show\Field|Collection cost_price
     * @property Show\Field|Collection order_id
     * @property Show\Field|Collection should_num
     * @property Show\Field|Collection apply_id
     * @property Show\Field|Collection order_no
     * @property Show\Field|Collection other
     * @property Show\Field|Collection with_id
     * @property Show\Field|Collection approval_type_id
     * @property Show\Field|Collection check_users
     * @property Show\Field|Collection desc
     * @property Show\Field|Collection attr_id
     * @property Show\Field|Collection caozuo
     * @property Show\Field|Collection check_at
     * @property Show\Field|Collection contract_money
     * @property Show\Field|Collection fee_type_id
     * @property Show\Field|Collection pay_at
     * @property Show\Field|Collection pay_method
     * @property Show\Field|Collection purchase_order_id
     * @property Show\Field|Collection this_time_money
     * @property Show\Field|Collection unpay_money
     * @property Show\Field|Collection zhanyong
     * @property Show\Field|Collection blackhead
     * @property Show\Field|Collection bulkiness
     * @property Show\Field|Collection carbon_fiber
     * @property Show\Field|Collection cleanliness
     * @property Show\Field|Collection duck_ratio
     * @property Show\Field|Collection feather_silk
     * @property Show\Field|Collection flower_number
     * @property Show\Field|Collection fluffy_silk
     * @property Show\Field|Collection heterochromatic_hair
     * @property Show\Field|Collection magazine
     * @property Show\Field|Collection moisture
     * @property Show\Field|Collection odor
     * @property Show\Field|Collection prev_sku_stock_batch_id
     * @property Show\Field|Collection raw_footage
     * @property Show\Field|Collection sku_stock_batch_id
     * @property Show\Field|Collection terrestrial_feather
     * @property Show\Field|Collection velvet
     * @property Show\Field|Collection bank
     * @property Show\Field|Collection bank_count
     * @property Show\Field|Collection hostname
     * @property Show\Field|Collection short_title
     * @property Show\Field|Collection tax_number
     * @property Show\Field|Collection actual_amount
     * @property Show\Field|Collection cost_type
     * @property Show\Field|Collection pay_type
     * @property Show\Field|Collection should_amount
     * @property Show\Field|Collection with_order_no
     * @property Show\Field|Collection accountant_item_id
     * @property Show\Field|Collection category
     * @property Show\Field|Collection company_name
     * @property Show\Field|Collection discount_amount
     * @property Show\Field|Collection settlement_amount
     * @property Show\Field|Collection settlement_completed
     * @property Show\Field|Collection total_amount
     * @property Show\Field|Collection address
     * @property Show\Field|Collection bank_account
     * @property Show\Field|Collection bank_name
     * @property Show\Field|Collection bank_title
     * @property Show\Field|Collection bank_top
     * @property Show\Field|Collection contact_department
     * @property Show\Field|Collection contact_email
     * @property Show\Field|Collection contact_qq
     * @property Show\Field|Collection contact_tel
     * @property Show\Field|Collection department
     * @property Show\Field|Collection link
     * @property Show\Field|Collection money_limit
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection sign_start_at
     * @property Show\Field|Collection sign_stop_at
     * @property Show\Field|Collection signatory
     * @property Show\Field|Collection tax_code
     * @property Show\Field|Collection customer_id
     * @property Show\Field|Collection drawee_id
     * @property Show\Field|Collection arrived_at
     * @property Show\Field|Collection company
     * @property Show\Field|Collection enclosure
     * @property Show\Field|Collection money
     * @property Show\Field|Collection order_type
     * @property Show\Field|Collection send_at
     * @property Show\Field|Collection content
     * @property Show\Field|Collection reply
     * @property Show\Field|Collection type
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection has_caozuo
     * @property Show\Field|Collection has_zhanyong
     * @property Show\Field|Collection caozuo_rate
     * @property Show\Field|Collection money_ccf
     * @property Show\Field|Collection money_czf
     * @property Show\Field|Collection money_jkgs
     * @property Show\Field|Collection money_other
     * @property Show\Field|Collection money_sc
     * @property Show\Field|Collection money_wlf
     * @property Show\Field|Collection money_yhsxf
     * @property Show\Field|Collection money_zy
     * @property Show\Field|Collection money_zzs
     * @property Show\Field|Collection pics
     * @property Show\Field|Collection products
     * @property Show\Field|Collection year_rate
     * @property Show\Field|Collection zhanyong_rate
     * @property Show\Field|Collection batch_no
     * @property Show\Field|Collection position_id
     * @property Show\Field|Collection diff_num
     * @property Show\Field|Collection sum_cost_price
     * @property Show\Field|Collection happen_date
     * @property Show\Field|Collection prefix
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection bar_code
     * @property Show\Field|Collection category_id
     * @property Show\Field|Collection item_no
     * @property Show\Field|Collection product_category_id
     * @property Show\Field|Collection product_date
     * @property Show\Field|Collection py_code
     * @property Show\Field|Collection quality_time
     * @property Show\Field|Collection stock_max
     * @property Show\Field|Collection stock_min
     * @property Show\Field|Collection unit_id
     * @property Show\Field|Collection attr_value_ids
     * @property Show\Field|Collection back_num
     * @property Show\Field|Collection purchase_order_back_id
     * @property Show\Field|Collection check_order_id
     * @property Show\Field|Collection apply_at
     * @property Show\Field|Collection finished_at
     * @property Show\Field|Collection supplier_id
     * @property Show\Field|Collection advance_charge_money
     * @property Show\Field|Collection check_status
     * @property Show\Field|Collection frame_contract_id
     * @property Show\Field|Collection sign_at
     * @property Show\Field|Collection sign_man
     * @property Show\Field|Collection accountant_id
     * @property Show\Field|Collection settlement_at
     * @property Show\Field|Collection back_at
     * @property Show\Field|Collection back_money
     * @property Show\Field|Collection store_id
     * @property Show\Field|Collection return_num
     * @property Show\Field|Collection address_id
     * @property Show\Field|Collection params
     * @property Show\Field|Collection total_money_cn
     * @property Show\Field|Collection profit
     * @property Show\Field|Collection sale_order_id
     * @property Show\Field|Collection already_actual_amount
     * @property Show\Field|Collection already_discount_amount
     * @property Show\Field|Collection order_amount
     * @property Show\Field|Collection statement_order_id
     * @property Show\Field|Collection balance_num
     * @property Show\Field|Collection flag
     * @property Show\Field|Collection in_num
     * @property Show\Field|Collection in_position_id
     * @property Show\Field|Collection in_price
     * @property Show\Field|Collection init_num
     * @property Show\Field|Collection inventory_diff_num
     * @property Show\Field|Collection inventory_num
     * @property Show\Field|Collection out_num
     * @property Show\Field|Collection out_position_id
     * @property Show\Field|Collection out_price
     * @property Show\Field|Collection store_in_id
     * @property Show\Field|Collection car_number
     * @property Show\Field|Collection delivery_id
     * @property Show\Field|Collection in_at
     * @property Show\Field|Collection store_out_id
     * @property Show\Field|Collection out_at
     * @property Show\Field|Collection man
     * @property Show\Field|Collection move_price
     * @property Show\Field|Collection position
     * @property Show\Field|Collection save_price
     * @property Show\Field|Collection store_company_id
     * @property Show\Field|Collection craft_id
     * @property Show\Field|Collection finish_num
     * @property Show\Field|Collection operator
     * @property Show\Field|Collection plan_num
     * @property Show\Field|Collection batch_id
     * @property Show\Field|Collection family_hash
     * @property Show\Field|Collection sequence
     * @property Show\Field|Collection should_display_on_index
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection entry_uuid
     * @property Show\Field|Collection tag
     * @property Show\Field|Collection email_verified_at
     *
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection alias(string $label = null)
     * @method Show\Field|Collection authors(string $label = null)
     * @method Show\Field|Collection enable(string $label = null)
     * @method Show\Field|Collection imported(string $label = null)
     * @method Show\Field|Collection config(string $label = null)
     * @method Show\Field|Collection require(string $label = null)
     * @method Show\Field|Collection require_dev(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection day(string $label = null)
     * @method Show\Field|Collection day_type(string $label = null)
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection year(string $label = null)
     * @method Show\Field|Collection accountant_date_id(string $label = null)
     * @method Show\Field|Collection end_at(string $label = null)
     * @method Show\Field|Collection month(string $label = null)
     * @method Show\Field|Collection start_at(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection input(string $label = null)
     * @method Show\Field|Collection ip(string $label = null)
     * @method Show\Field|Collection method(string $label = null)
     * @method Show\Field|Collection path(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection company_id(string $label = null)
     * @method Show\Field|Collection deleted_at(string $label = null)
     * @method Show\Field|Collection department_id(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection tel(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection allocation_id(string $label = null)
     * @method Show\Field|Collection num(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection product_id(string $label = null)
     * @method Show\Field|Collection sku_id(string $label = null)
     * @method Show\Field|Collection sum_price(string $label = null)
     * @method Show\Field|Collection charge_man(string $label = null)
     * @method Show\Field|Collection in_store_id(string $label = null)
     * @method Show\Field|Collection mark(string $label = null)
     * @method Show\Field|Collection out_store_id(string $label = null)
     * @method Show\Field|Collection review_status(string $label = null)
     * @method Show\Field|Collection sn(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection total_money(string $label = null)
     * @method Show\Field|Collection trans_at(string $label = null)
     * @method Show\Field|Collection actual_num(string $label = null)
     * @method Show\Field|Collection item_id(string $label = null)
     * @method Show\Field|Collection percent(string $label = null)
     * @method Show\Field|Collection standard(string $label = null)
     * @method Show\Field|Collection stock_batch_id(string $label = null)
     * @method Show\Field|Collection cost_price(string $label = null)
     * @method Show\Field|Collection order_id(string $label = null)
     * @method Show\Field|Collection should_num(string $label = null)
     * @method Show\Field|Collection apply_id(string $label = null)
     * @method Show\Field|Collection order_no(string $label = null)
     * @method Show\Field|Collection other(string $label = null)
     * @method Show\Field|Collection with_id(string $label = null)
     * @method Show\Field|Collection approval_type_id(string $label = null)
     * @method Show\Field|Collection check_users(string $label = null)
     * @method Show\Field|Collection desc(string $label = null)
     * @method Show\Field|Collection attr_id(string $label = null)
     * @method Show\Field|Collection caozuo(string $label = null)
     * @method Show\Field|Collection check_at(string $label = null)
     * @method Show\Field|Collection contract_money(string $label = null)
     * @method Show\Field|Collection fee_type_id(string $label = null)
     * @method Show\Field|Collection pay_at(string $label = null)
     * @method Show\Field|Collection pay_method(string $label = null)
     * @method Show\Field|Collection purchase_order_id(string $label = null)
     * @method Show\Field|Collection this_time_money(string $label = null)
     * @method Show\Field|Collection unpay_money(string $label = null)
     * @method Show\Field|Collection zhanyong(string $label = null)
     * @method Show\Field|Collection blackhead(string $label = null)
     * @method Show\Field|Collection bulkiness(string $label = null)
     * @method Show\Field|Collection carbon_fiber(string $label = null)
     * @method Show\Field|Collection cleanliness(string $label = null)
     * @method Show\Field|Collection duck_ratio(string $label = null)
     * @method Show\Field|Collection feather_silk(string $label = null)
     * @method Show\Field|Collection flower_number(string $label = null)
     * @method Show\Field|Collection fluffy_silk(string $label = null)
     * @method Show\Field|Collection heterochromatic_hair(string $label = null)
     * @method Show\Field|Collection magazine(string $label = null)
     * @method Show\Field|Collection moisture(string $label = null)
     * @method Show\Field|Collection odor(string $label = null)
     * @method Show\Field|Collection prev_sku_stock_batch_id(string $label = null)
     * @method Show\Field|Collection raw_footage(string $label = null)
     * @method Show\Field|Collection sku_stock_batch_id(string $label = null)
     * @method Show\Field|Collection terrestrial_feather(string $label = null)
     * @method Show\Field|Collection velvet(string $label = null)
     * @method Show\Field|Collection bank(string $label = null)
     * @method Show\Field|Collection bank_count(string $label = null)
     * @method Show\Field|Collection hostname(string $label = null)
     * @method Show\Field|Collection short_title(string $label = null)
     * @method Show\Field|Collection tax_number(string $label = null)
     * @method Show\Field|Collection actual_amount(string $label = null)
     * @method Show\Field|Collection cost_type(string $label = null)
     * @method Show\Field|Collection pay_type(string $label = null)
     * @method Show\Field|Collection should_amount(string $label = null)
     * @method Show\Field|Collection with_order_no(string $label = null)
     * @method Show\Field|Collection accountant_item_id(string $label = null)
     * @method Show\Field|Collection category(string $label = null)
     * @method Show\Field|Collection company_name(string $label = null)
     * @method Show\Field|Collection discount_amount(string $label = null)
     * @method Show\Field|Collection settlement_amount(string $label = null)
     * @method Show\Field|Collection settlement_completed(string $label = null)
     * @method Show\Field|Collection total_amount(string $label = null)
     * @method Show\Field|Collection address(string $label = null)
     * @method Show\Field|Collection bank_account(string $label = null)
     * @method Show\Field|Collection bank_name(string $label = null)
     * @method Show\Field|Collection bank_title(string $label = null)
     * @method Show\Field|Collection bank_top(string $label = null)
     * @method Show\Field|Collection contact_department(string $label = null)
     * @method Show\Field|Collection contact_email(string $label = null)
     * @method Show\Field|Collection contact_qq(string $label = null)
     * @method Show\Field|Collection contact_tel(string $label = null)
     * @method Show\Field|Collection department(string $label = null)
     * @method Show\Field|Collection link(string $label = null)
     * @method Show\Field|Collection money_limit(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection sign_start_at(string $label = null)
     * @method Show\Field|Collection sign_stop_at(string $label = null)
     * @method Show\Field|Collection signatory(string $label = null)
     * @method Show\Field|Collection tax_code(string $label = null)
     * @method Show\Field|Collection customer_id(string $label = null)
     * @method Show\Field|Collection drawee_id(string $label = null)
     * @method Show\Field|Collection arrived_at(string $label = null)
     * @method Show\Field|Collection company(string $label = null)
     * @method Show\Field|Collection enclosure(string $label = null)
     * @method Show\Field|Collection money(string $label = null)
     * @method Show\Field|Collection order_type(string $label = null)
     * @method Show\Field|Collection send_at(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection reply(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection has_caozuo(string $label = null)
     * @method Show\Field|Collection has_zhanyong(string $label = null)
     * @method Show\Field|Collection caozuo_rate(string $label = null)
     * @method Show\Field|Collection money_ccf(string $label = null)
     * @method Show\Field|Collection money_czf(string $label = null)
     * @method Show\Field|Collection money_jkgs(string $label = null)
     * @method Show\Field|Collection money_other(string $label = null)
     * @method Show\Field|Collection money_sc(string $label = null)
     * @method Show\Field|Collection money_wlf(string $label = null)
     * @method Show\Field|Collection money_yhsxf(string $label = null)
     * @method Show\Field|Collection money_zy(string $label = null)
     * @method Show\Field|Collection money_zzs(string $label = null)
     * @method Show\Field|Collection pics(string $label = null)
     * @method Show\Field|Collection products(string $label = null)
     * @method Show\Field|Collection year_rate(string $label = null)
     * @method Show\Field|Collection zhanyong_rate(string $label = null)
     * @method Show\Field|Collection batch_no(string $label = null)
     * @method Show\Field|Collection position_id(string $label = null)
     * @method Show\Field|Collection diff_num(string $label = null)
     * @method Show\Field|Collection sum_cost_price(string $label = null)
     * @method Show\Field|Collection happen_date(string $label = null)
     * @method Show\Field|Collection prefix(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection bar_code(string $label = null)
     * @method Show\Field|Collection category_id(string $label = null)
     * @method Show\Field|Collection item_no(string $label = null)
     * @method Show\Field|Collection product_category_id(string $label = null)
     * @method Show\Field|Collection product_date(string $label = null)
     * @method Show\Field|Collection py_code(string $label = null)
     * @method Show\Field|Collection quality_time(string $label = null)
     * @method Show\Field|Collection stock_max(string $label = null)
     * @method Show\Field|Collection stock_min(string $label = null)
     * @method Show\Field|Collection unit_id(string $label = null)
     * @method Show\Field|Collection attr_value_ids(string $label = null)
     * @method Show\Field|Collection back_num(string $label = null)
     * @method Show\Field|Collection purchase_order_back_id(string $label = null)
     * @method Show\Field|Collection check_order_id(string $label = null)
     * @method Show\Field|Collection apply_at(string $label = null)
     * @method Show\Field|Collection finished_at(string $label = null)
     * @method Show\Field|Collection supplier_id(string $label = null)
     * @method Show\Field|Collection advance_charge_money(string $label = null)
     * @method Show\Field|Collection check_status(string $label = null)
     * @method Show\Field|Collection frame_contract_id(string $label = null)
     * @method Show\Field|Collection sign_at(string $label = null)
     * @method Show\Field|Collection sign_man(string $label = null)
     * @method Show\Field|Collection accountant_id(string $label = null)
     * @method Show\Field|Collection settlement_at(string $label = null)
     * @method Show\Field|Collection back_at(string $label = null)
     * @method Show\Field|Collection back_money(string $label = null)
     * @method Show\Field|Collection store_id(string $label = null)
     * @method Show\Field|Collection return_num(string $label = null)
     * @method Show\Field|Collection address_id(string $label = null)
     * @method Show\Field|Collection params(string $label = null)
     * @method Show\Field|Collection total_money_cn(string $label = null)
     * @method Show\Field|Collection profit(string $label = null)
     * @method Show\Field|Collection sale_order_id(string $label = null)
     * @method Show\Field|Collection already_actual_amount(string $label = null)
     * @method Show\Field|Collection already_discount_amount(string $label = null)
     * @method Show\Field|Collection order_amount(string $label = null)
     * @method Show\Field|Collection statement_order_id(string $label = null)
     * @method Show\Field|Collection balance_num(string $label = null)
     * @method Show\Field|Collection flag(string $label = null)
     * @method Show\Field|Collection in_num(string $label = null)
     * @method Show\Field|Collection in_position_id(string $label = null)
     * @method Show\Field|Collection in_price(string $label = null)
     * @method Show\Field|Collection init_num(string $label = null)
     * @method Show\Field|Collection inventory_diff_num(string $label = null)
     * @method Show\Field|Collection inventory_num(string $label = null)
     * @method Show\Field|Collection out_num(string $label = null)
     * @method Show\Field|Collection out_position_id(string $label = null)
     * @method Show\Field|Collection out_price(string $label = null)
     * @method Show\Field|Collection store_in_id(string $label = null)
     * @method Show\Field|Collection car_number(string $label = null)
     * @method Show\Field|Collection delivery_id(string $label = null)
     * @method Show\Field|Collection in_at(string $label = null)
     * @method Show\Field|Collection store_out_id(string $label = null)
     * @method Show\Field|Collection out_at(string $label = null)
     * @method Show\Field|Collection man(string $label = null)
     * @method Show\Field|Collection move_price(string $label = null)
     * @method Show\Field|Collection position(string $label = null)
     * @method Show\Field|Collection save_price(string $label = null)
     * @method Show\Field|Collection store_company_id(string $label = null)
     * @method Show\Field|Collection craft_id(string $label = null)
     * @method Show\Field|Collection finish_num(string $label = null)
     * @method Show\Field|Collection operator(string $label = null)
     * @method Show\Field|Collection plan_num(string $label = null)
     * @method Show\Field|Collection batch_id(string $label = null)
     * @method Show\Field|Collection family_hash(string $label = null)
     * @method Show\Field|Collection sequence(string $label = null)
     * @method Show\Field|Collection should_display_on_index(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection entry_uuid(string $label = null)
     * @method Show\Field|Collection tag(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     */
    class Show {}

    /**
     * @method \App\Admin\Extensions\Form\Fee fee(...$params)
     * @method \App\Admin\Extensions\Form\Num num(...$params)
     * @method \App\Admin\Extensions\Form\TableDecimal tableDecimal(...$params)
     * @method \App\Admin\Extensions\Form\Input ipt(...$params)
     * @method \App\Admin\Extensions\Form\ReviewIcon reviewicon(...$params)
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     * @method $this emp(...$params)
     * @method $this fee(...$params)
     * @method $this edit(...$params)
     * @method $this selectplus(...$params)
     * @method $this batch_detail(...$params)
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
